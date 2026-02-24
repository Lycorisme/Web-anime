/**
 * Palette Image Editor — Alpine.js Component
 * Full client-side image editor using Canvas API
 * 
 * Features (Phase 1): Crop, Rotate, Flip, Brightness, Contrast, Undo/Redo, Reset
 */

document.addEventListener('alpine:init', () => {

    Alpine.data('paletteEditor', () => ({

        // ── State ──
        isOpen: false,
        activeTool: 'adjust', // 'crop' | 'transform' | 'adjust' | 'filter'
        originalImageSrc: null,
        originalImage: null,

        // Canvas refs
        canvas: null,
        ctx: null,

        // Dimensions
        canvasWidth: 0,
        canvasHeight: 0,
        naturalWidth: 0,
        naturalHeight: 0,

        // History (Blob URL stack, max 10)
        history: [],
        historyIndex: -1,
        maxHistory: 10,
        isProcessing: false,

        // Zoom
        zoom: 100,

        // ── Adjustments ──
        brightness: 100,
        contrast: 100,
        saturation: 100,
        hueRotate: 0,
        opacity: 100,

        // ── Filters ──
        grayscale: 0,
        sepia: 0,
        invert: 0,
        blur: 0,

        // ── Crop State ──
        isCropping: false,
        cropStarted: false,
        cropRatio: 'free', // 'free' | '1:1' | '16:9' | '4:3'
        cropBox: { x: 0, y: 0, w: 0, h: 0 },
        cropDragging: false,
        cropDragType: null, // 'move' | 'tl' | 'tr' | 'bl' | 'br'
        cropDragStart: { x: 0, y: 0 },
        cropBoxStart: { x: 0, y: 0, w: 0, h: 0 },

        // ── Transform State ──
        rotation: 0, // cumulative degrees
        flipH: false,
        flipV: false,

        // ── Livewire Integration ──
        targetInputId: null,

        // ─────────────────────────────────
        //  LIFECYCLE
        // ─────────────────────────────────

        init() {
            // Listen for open events
            window.addEventListener('open-palette-editor', (e) => {
                this.openEditor(e.detail);
            });

            // Keyboard shortcuts
            window.addEventListener('keydown', (e) => {
                if (!this.isOpen) return;

                if (e.key === 'Escape') {
                    if (this.isCropping) {
                        this.cancelCrop();
                    } else {
                        this.closeEditor();
                    }
                }
                if ((e.ctrlKey || e.metaKey) && e.key === 'z' && !e.shiftKey) {
                    e.preventDefault();
                    this.undo();
                }
                if ((e.ctrlKey || e.metaKey) && (e.key === 'y' || (e.shiftKey && e.key === 'z'))) {
                    e.preventDefault();
                    this.redo();
                }
            });
        },

        // ─────────────────────────────────
        //  OPEN / CLOSE
        // ─────────────────────────────────

        openEditor(detail) {
            this.resetState();

            const { src, targetInputId } = detail;
            this.targetInputId = targetInputId || null;
            this.originalImageSrc = src;

            this.isOpen = true;
            document.body.style.overflow = 'hidden';

            this.$nextTick(() => {
                this.canvas = this.$refs.editorCanvas;
                this.ctx = this.canvas.getContext('2d', { willReadFrequently: true });
                this.loadImage(src);
            });
        },

        closeEditor() {
            this.isOpen = false;
            document.body.style.overflow = '';
            // Revoke all blob URLs
            this.history.forEach(url => URL.revokeObjectURL(url));
            this.history = [];
            this.historyIndex = -1;
        },

        resetState() {
            this.activeTool = 'adjust';
            this.brightness = 100;
            this.contrast = 100;
            this.saturation = 100;
            this.hueRotate = 0;
            this.opacity = 100;
            this.grayscale = 0;
            this.sepia = 0;
            this.invert = 0;
            this.blur = 0;
            this.rotation = 0;
            this.flipH = false;
            this.flipV = false;
            this.zoom = 100;
            this.isCropping = false;
            this.cropStarted = false;
            this.cropRatio = 'free';
            this.isProcessing = false;
            this.history.forEach(url => URL.revokeObjectURL(url));
            this.history = [];
            this.historyIndex = -1;
        },

        // ─────────────────────────────────
        //  IMAGE LOADING
        // ─────────────────────────────────

        loadImage(src) {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = () => {
                this.originalImage = img;
                this.naturalWidth = img.naturalWidth;
                this.naturalHeight = img.naturalHeight;

                // Fit canvas to container
                this.fitCanvas(img.naturalWidth, img.naturalHeight);

                // Draw initial
                this.drawImage();

                // Save initial state
                this.saveHistory();
            };
            img.src = src;
        },

        fitCanvas(w, h) {
            const container = this.$refs.canvasArea;
            if (!container) return;

            const maxW = container.clientWidth * 0.88;
            const maxH = container.clientHeight * 0.88;
            const scale = Math.min(maxW / w, maxH / h, 1);

            this.canvasWidth = Math.round(w * scale);
            this.canvasHeight = Math.round(h * scale);
            this.canvas.width = w;
            this.canvas.height = h;
            this.canvas.style.width = this.canvasWidth + 'px';
            this.canvas.style.height = this.canvasHeight + 'px';
        },

        drawImage() {
            if (!this.ctx || !this.originalImage) return;

            const { ctx, canvas } = this;
            const img = this.originalImage;

            // Clear
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Build CSS filter string
            const filters = [
                `brightness(${this.brightness}%)`,
                `contrast(${this.contrast}%)`,
                `saturate(${this.saturation}%)`,
                `hue-rotate(${this.hueRotate}deg)`,
                `grayscale(${this.grayscale}%)`,
                `sepia(${this.sepia}%)`,
                `invert(${this.invert}%)`,
                `blur(${this.blur}px)`,
            ].join(' ');

            ctx.save();
            ctx.filter = filters;
            ctx.globalAlpha = this.opacity / 100;

            // Apply transforms
            ctx.translate(canvas.width / 2, canvas.height / 2);
            ctx.rotate((this.rotation * Math.PI) / 180);
            ctx.scale(this.flipH ? -1 : 1, this.flipV ? -1 : 1);

            // Handle rotation — swap draw dimensions for 90/270
            const isRotated90 = (this.rotation % 180 !== 0);
            if (isRotated90) {
                const scale270 = Math.min(canvas.width / img.naturalHeight, canvas.height / img.naturalWidth);
                ctx.drawImage(img,
                    -img.naturalWidth * scale270 / 2,
                    -img.naturalHeight * scale270 / 2,
                    img.naturalWidth * scale270,
                    img.naturalHeight * scale270
                );
            } else {
                ctx.drawImage(img, -canvas.width / 2, -canvas.height / 2, canvas.width, canvas.height);
            }

            ctx.restore();
        },

        // ─────────────────────────────────
        //  HISTORY (Blob URL based)
        // ─────────────────────────────────

        saveHistory() {
            if (!this.canvas) return;

            this.canvas.toBlob((blob) => {
                if (!blob) return;

                // If we're not at the end, remove future states
                if (this.historyIndex < this.history.length - 1) {
                    const removed = this.history.splice(this.historyIndex + 1);
                    removed.forEach(url => URL.revokeObjectURL(url));
                }

                // Remove oldest if at max
                if (this.history.length >= this.maxHistory) {
                    URL.revokeObjectURL(this.history.shift());
                }

                const url = URL.createObjectURL(blob);
                this.history.push(url);
                this.historyIndex = this.history.length - 1;
            }, 'image/png');
        },

        undo() {
            if (this.historyIndex <= 0 || this.isProcessing) return;
            this.historyIndex--;
            this.restoreFromHistory();
        },

        redo() {
            if (this.historyIndex >= this.history.length - 1 || this.isProcessing) return;
            this.historyIndex++;
            this.restoreFromHistory();
        },

        restoreFromHistory() {
            this.isProcessing = true;
            const img = new Image();
            img.onload = () => {
                this.canvas.width = img.naturalWidth;
                this.canvas.height = img.naturalHeight;
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.ctx.drawImage(img, 0, 0);
                this.isProcessing = false;

                // Reset all adjustments since the history captures the full state
                this.brightness = 100;
                this.contrast = 100;
                this.saturation = 100;
                this.hueRotate = 0;
                this.opacity = 100;
                this.grayscale = 0;
                this.sepia = 0;
                this.invert = 0;
                this.blur = 0;
            };
            img.src = this.history[this.historyIndex];
        },

        resetAll() {
            this.resetState();
            this.$nextTick(() => {
                this.canvas = this.$refs.editorCanvas;
                this.ctx = this.canvas.getContext('2d', { willReadFrequently: true });
                this.loadImage(this.originalImageSrc);
            });
        },

        get canUndo() {
            return this.historyIndex > 0;
        },

        get canRedo() {
            return this.historyIndex < this.history.length - 1;
        },

        // ─────────────────────────────────
        //  ADJUSTMENTS (Live preview)
        // ─────────────────────────────────

        onAdjustmentChange() {
            this.drawImage();
        },

        applyAdjustments() {
            // Flatten current filters into pixel data
            this.drawImage();
            this.flattenCanvas();
            this.saveHistory();

            // Reset adjustments after applying
            this.brightness = 100;
            this.contrast = 100;
            this.saturation = 100;
            this.hueRotate = 0;
            this.opacity = 100;
            this.grayscale = 0;
            this.sepia = 0;
            this.invert = 0;
            this.blur = 0;
            this.rotation = 0;
            this.flipH = false;
            this.flipV = false;
        },

        flattenCanvas() {
            // Create a new image from the current canvas state
            const imgData = this.ctx.getImageData(0, 0, this.canvas.width, this.canvas.height);
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = this.canvas.width;
            tempCanvas.height = this.canvas.height;
            const tempCtx = tempCanvas.getContext('2d');
            tempCtx.putImageData(imgData, 0, 0);

            // Create new image from flattened data
            const newImg = new Image();
            newImg.onload = () => {
                this.originalImage = newImg;
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.ctx.drawImage(newImg, 0, 0);
            };
            newImg.src = tempCanvas.toDataURL('image/png');
        },

        // ─────────────────────────────────
        //  TRANSFORM: Rotate
        // ─────────────────────────────────

        rotateCW() {
            this.applyRotation(90);
        },

        rotateCCW() {
            this.applyRotation(-90);
        },

        rotate180() {
            this.applyRotation(180);
        },

        applyRotation(degrees) {
            if (this.isProcessing) return;
            this.isProcessing = true;

            const img = this.originalImage;
            if (!img) { this.isProcessing = false; return; }

            // First draw current state with current filters
            this.drawImage();

            const srcCanvas = document.createElement('canvas');
            srcCanvas.width = this.canvas.width;
            srcCanvas.height = this.canvas.height;
            const srcCtx = srcCanvas.getContext('2d');
            srcCtx.drawImage(this.canvas, 0, 0);

            // Calculate new dimensions
            const rad = (degrees * Math.PI) / 180;
            const absCos = Math.abs(Math.cos(rad));
            const absSin = Math.abs(Math.sin(rad));
            const newW = Math.round(srcCanvas.width * absCos + srcCanvas.height * absSin);
            const newH = Math.round(srcCanvas.width * absSin + srcCanvas.height * absCos);

            this.canvas.width = newW;
            this.canvas.height = newH;
            this.fitCanvasDisplay(newW, newH);

            this.ctx.clearRect(0, 0, newW, newH);
            this.ctx.save();
            this.ctx.translate(newW / 2, newH / 2);
            this.ctx.rotate(rad);
            this.ctx.drawImage(srcCanvas, -srcCanvas.width / 2, -srcCanvas.height / 2);
            this.ctx.restore();

            // Reset transforms and flatten
            this.rotation = 0;
            this.flipH = false;
            this.flipV = false;
            this.brightness = 100;
            this.contrast = 100;
            this.saturation = 100;
            this.hueRotate = 0;
            this.opacity = 100;
            this.grayscale = 0;
            this.sepia = 0;
            this.invert = 0;
            this.blur = 0;

            // Update original image to new state
            const newImg = new Image();
            newImg.onload = () => {
                this.originalImage = newImg;
                this.naturalWidth = newW;
                this.naturalHeight = newH;
                this.saveHistory();
                this.isProcessing = false;
            };
            newImg.src = this.canvas.toDataURL('image/png');
        },

        fitCanvasDisplay(w, h) {
            const container = this.$refs.canvasArea;
            if (!container) return;
            const maxW = container.clientWidth * 0.88;
            const maxH = container.clientHeight * 0.88;
            const scale = Math.min(maxW / w, maxH / h, 1);
            this.canvasWidth = Math.round(w * scale);
            this.canvasHeight = Math.round(h * scale);
            this.canvas.style.width = this.canvasWidth + 'px';
            this.canvas.style.height = this.canvasHeight + 'px';
        },

        // ─────────────────────────────────
        //  TRANSFORM: Flip
        // ─────────────────────────────────

        doFlipH() {
            if (this.isProcessing) return;
            this.isProcessing = true;

            // Draw current state
            this.drawImage();

            const srcCanvas = document.createElement('canvas');
            srcCanvas.width = this.canvas.width;
            srcCanvas.height = this.canvas.height;
            srcCanvas.getContext('2d').drawImage(this.canvas, 0, 0);

            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.ctx.save();
            this.ctx.translate(this.canvas.width, 0);
            this.ctx.scale(-1, 1);
            this.ctx.drawImage(srcCanvas, 0, 0);
            this.ctx.restore();

            // Reset and flatten
            this.flipH = false;
            this.flipV = false;
            this.rotation = 0;
            this.brightness = 100;
            this.contrast = 100;
            this.saturation = 100;
            this.hueRotate = 0;
            this.opacity = 100;
            this.grayscale = 0;
            this.sepia = 0;
            this.invert = 0;
            this.blur = 0;

            const newImg = new Image();
            newImg.onload = () => {
                this.originalImage = newImg;
                this.saveHistory();
                this.isProcessing = false;
            };
            newImg.src = this.canvas.toDataURL('image/png');
        },

        doFlipV() {
            if (this.isProcessing) return;
            this.isProcessing = true;

            this.drawImage();

            const srcCanvas = document.createElement('canvas');
            srcCanvas.width = this.canvas.width;
            srcCanvas.height = this.canvas.height;
            srcCanvas.getContext('2d').drawImage(this.canvas, 0, 0);

            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.ctx.save();
            this.ctx.translate(0, this.canvas.height);
            this.ctx.scale(1, -1);
            this.ctx.drawImage(srcCanvas, 0, 0);
            this.ctx.restore();

            this.flipH = false;
            this.flipV = false;
            this.rotation = 0;
            this.brightness = 100;
            this.contrast = 100;
            this.saturation = 100;
            this.hueRotate = 0;
            this.opacity = 100;
            this.grayscale = 0;
            this.sepia = 0;
            this.invert = 0;
            this.blur = 0;

            const newImg = new Image();
            newImg.onload = () => {
                this.originalImage = newImg;
                this.saveHistory();
                this.isProcessing = false;
            };
            newImg.src = this.canvas.toDataURL('image/png');
        },

        // ─────────────────────────────────
        //  CROP
        // ─────────────────────────────────

        startCrop() {
            this.activeTool = 'crop';
            this.isCropping = true;
            this.cropStarted = false;

            // Default crop box: centered 80% of canvas display
            const w = this.canvasWidth * 0.8;
            const h = this.canvasHeight * 0.8;
            this.cropBox = {
                x: (this.canvasWidth - w) / 2,
                y: (this.canvasHeight - h) / 2,
                w: w,
                h: h
            };
            this.applyCropRatio();
            this.cropStarted = true;
        },

        setCropRatio(ratio) {
            this.cropRatio = ratio;
            if (this.cropStarted) {
                this.applyCropRatio();
            }
        },

        applyCropRatio() {
            if (this.cropRatio === 'free') return;

            const ratios = {
                '1:1': 1,
                '16:9': 16 / 9,
                '4:3': 4 / 3,
                '9:16': 9 / 16,
                '3:4': 3 / 4,
            };

            const r = ratios[this.cropRatio];
            if (!r) return;

            let { x, y, w, h } = this.cropBox;
            const newH = w / r;

            if (newH > this.canvasHeight * 0.9) {
                h = this.canvasHeight * 0.9;
                w = h * r;
            } else {
                h = newH;
            }

            // Re-center
            x = (this.canvasWidth - w) / 2;
            y = (this.canvasHeight - h) / 2;

            this.cropBox = { x, y, w, h };
        },

        // ── Crop Drag Handlers ──
        onCropMouseDown(e, type) {
            e.preventDefault();
            e.stopPropagation();
            this.cropDragging = true;
            this.cropDragType = type;

            const rect = this.$refs.cropOverlay.getBoundingClientRect();
            this.cropDragStart = {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
            this.cropBoxStart = { ...this.cropBox };

            const onMove = (me) => this.onCropMouseMove(me);
            const onUp = () => {
                this.cropDragging = false;
                this.cropDragType = null;
                document.removeEventListener('mousemove', onMove);
                document.removeEventListener('mouseup', onUp);
            };

            document.addEventListener('mousemove', onMove);
            document.addEventListener('mouseup', onUp);
        },

        onCropMouseMove(e) {
            if (!this.cropDragging) return;

            const rect = this.$refs.cropOverlay.getBoundingClientRect();
            const mx = e.clientX - rect.left;
            const my = e.clientY - rect.top;
            const dx = mx - this.cropDragStart.x;
            const dy = my - this.cropDragStart.y;

            const b = this.cropBoxStart;
            const maxW = this.canvasWidth;
            const maxH = this.canvasHeight;

            if (this.cropDragType === 'move') {
                let nx = b.x + dx;
                let ny = b.y + dy;
                nx = Math.max(0, Math.min(nx, maxW - b.w));
                ny = Math.max(0, Math.min(ny, maxH - b.h));
                this.cropBox = { ...this.cropBox, x: nx, y: ny };
            } else {
                // Resize handles
                let nx = b.x, ny = b.y, nw = b.w, nh = b.h;

                if (this.cropDragType.includes('r')) {
                    nw = Math.max(30, b.w + dx);
                    nw = Math.min(nw, maxW - b.x);
                }
                if (this.cropDragType.includes('l')) {
                    const newX = b.x + dx;
                    nw = b.w - dx;
                    if (nw >= 30 && newX >= 0) {
                        nx = newX;
                    } else {
                        nw = b.w;
                    }
                }
                if (this.cropDragType.includes('b')) {
                    nh = Math.max(30, b.h + dy);
                    nh = Math.min(nh, maxH - b.y);
                }
                if (this.cropDragType.includes('t')) {
                    const newY = b.y + dy;
                    nh = b.h - dy;
                    if (nh >= 30 && newY >= 0) {
                        ny = newY;
                    } else {
                        nh = b.h;
                    }
                }

                // Lock ratio if needed
                if (this.cropRatio !== 'free') {
                    const ratios = { '1:1': 1, '16:9': 16 / 9, '4:3': 4 / 3, '9:16': 9 / 16, '3:4': 3 / 4 };
                    const r = ratios[this.cropRatio];
                    if (r) {
                        nh = nw / r;
                        if (ny + nh > maxH) {
                            nh = maxH - ny;
                            nw = nh * r;
                        }
                    }
                }

                nw = Math.min(nw, maxW);
                nh = Math.min(nh, maxH);

                this.cropBox = { x: nx, y: ny, w: nw, h: nh };
            }
        },

        // Touch support for crop
        onCropTouchStart(e, type) {
            if (e.touches.length !== 1) return;
            const touch = e.touches[0];
            this.onCropMouseDown({
                clientX: touch.clientX,
                clientY: touch.clientY,
                preventDefault: () => e.preventDefault(),
                stopPropagation: () => e.stopPropagation()
            }, type);

            const onTouchMove = (te) => {
                if (te.touches.length !== 1) return;
                this.onCropMouseMove({ clientX: te.touches[0].clientX, clientY: te.touches[0].clientY });
            };
            const onTouchEnd = () => {
                this.cropDragging = false;
                this.cropDragType = null;
                document.removeEventListener('touchmove', onTouchMove);
                document.removeEventListener('touchend', onTouchEnd);
            };
            document.addEventListener('touchmove', onTouchMove, { passive: false });
            document.addEventListener('touchend', onTouchEnd);
        },

        applyCrop() {
            if (!this.cropStarted || this.isProcessing) return;
            this.isProcessing = true;

            // Calculate actual canvas coordinates from display coordinates
            const scaleX = this.canvas.width / this.canvasWidth;
            const scaleY = this.canvas.height / this.canvasHeight;

            const sx = Math.round(this.cropBox.x * scaleX);
            const sy = Math.round(this.cropBox.y * scaleY);
            const sw = Math.round(this.cropBox.w * scaleX);
            const sh = Math.round(this.cropBox.h * scaleY);

            // Get cropped region
            const imgData = this.ctx.getImageData(sx, sy, sw, sh);

            // Resize canvas
            this.canvas.width = sw;
            this.canvas.height = sh;
            this.fitCanvasDisplay(sw, sh);

            this.ctx.putImageData(imgData, 0, 0);

            // Update original image
            const newImg = new Image();
            newImg.onload = () => {
                this.originalImage = newImg;
                this.naturalWidth = sw;
                this.naturalHeight = sh;
                this.isCropping = false;
                this.cropStarted = false;
                this.saveHistory();
                this.isProcessing = false;
            };
            newImg.src = this.canvas.toDataURL('image/png');
        },

        cancelCrop() {
            this.isCropping = false;
            this.cropStarted = false;
            this.activeTool = 'adjust';
        },

        get cropDisplayInfo() {
            if (!this.cropStarted) return '';
            const scaleX = this.canvas.width / this.canvasWidth;
            const scaleY = this.canvas.height / this.canvasHeight;
            return `${Math.round(this.cropBox.w * scaleX)} × ${Math.round(this.cropBox.h * scaleY)}`;
        },

        // ─────────────────────────────────
        //  ZOOM
        // ─────────────────────────────────

        zoomIn() {
            this.zoom = Math.min(this.zoom + 10, 200);
            this.applyZoom();
        },

        zoomOut() {
            this.zoom = Math.max(this.zoom - 10, 30);
            this.applyZoom();
        },

        zoomReset() {
            this.zoom = 100;
            this.applyZoom();
        },

        applyZoom() {
            if (this.$refs.canvasWrapper) {
                this.$refs.canvasWrapper.style.transform = `scale(${this.zoom / 100})`;
            }
        },

        // ─────────────────────────────────
        //  APPLY & EXPORT
        // ─────────────────────────────────

        applyAndClose() {
            if (this.isProcessing) return;
            this.isProcessing = true;

            // First apply any pending adjustments
            this.drawImage();

            // Export as JPEG for smaller file size
            this.canvas.toBlob((blob) => {
                if (!blob) {
                    console.error('Palette Editor: toBlob returned null');
                    this.isProcessing = false;
                    return;
                }

                const file = new File([blob], 'edited-image.jpg', {
                    type: 'image/jpeg',
                    lastModified: Date.now()
                });

                console.log('Palette Editor: File created', file.size, 'bytes');

                // Dispatch event with the file for the form to pick up
                window.dispatchEvent(new CustomEvent('palette-editor-done', {
                    detail: { file: file }
                }));

                // Also try direct injection if targetInputId is set
                if (this.targetInputId) {
                    const input = document.getElementById(this.targetInputId);
                    if (input) {
                        const dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                        console.log('Palette Editor: File injected into', this.targetInputId);
                    }
                }

                this.isProcessing = false;
                this.closeEditor();
            }, 'image/jpeg', 0.92);
        },

        // ─────────────────────────────────
        //  TOOL SWITCHING
        // ─────────────────────────────────

        setTool(tool) {
            if (this.isCropping && tool !== 'crop') {
                this.cancelCrop();
            }
            this.activeTool = tool;

            if (tool === 'crop') {
                this.startCrop();
            }
        },

        // ─────────────────────────────────
        //  HELPERS
        // ─────────────────────────────────

        get dimensionInfo() {
            return `${this.canvas?.width || 0} × ${this.canvas?.height || 0}`;
        },

        get hasChanges() {
            return this.brightness !== 100 || this.contrast !== 100 ||
                this.saturation !== 100 || this.hueRotate !== 0 ||
                this.opacity !== 100 || this.grayscale !== 0 ||
                this.sepia !== 0 || this.invert !== 0 || this.blur !== 0;
        },

    }));
});
