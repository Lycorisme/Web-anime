{{-- Palette Image Editor Modal --}}
{{-- Usage: Include this at the bottom of any page, then dispatch 'open-palette-editor' event --}}
<template x-teleport="body">
    <div x-data="paletteEditor"
         x-show="isOpen"
         x-cloak
         class="pie-editor"
         style="display: none;">

        {{-- Backdrop --}}
        <div x-show="isOpen"
             class="pie-backdrop pie-backdrop-animate"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        {{-- ═══ HEADER ═══ --}}
        <div class="pie-header pie-animate-in">
            <div class="pie-header-title">
                <div class="pie-icon-badge">
                    <i class="bi bi-palette"></i>
                </div>
                <span>Palette Editor</span>
            </div>

            <div class="pie-header-actions">
                {{-- Undo / Redo --}}
                <button class="pie-btn-icon" @click="undo()" :class="{ 'opacity-30 cursor-not-allowed': !canUndo }" :disabled="!canUndo" title="Undo (Ctrl+Z)">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
                <button class="pie-btn-icon" @click="redo()" :class="{ 'opacity-30 cursor-not-allowed': !canRedo }" :disabled="!canRedo" title="Redo (Ctrl+Y)">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>

                <div style="width: 1px; height: 24px; background: rgba(255,255,255,0.1);"></div>

                {{-- Reset --}}
                <button class="pie-btn pie-btn-danger" @click="resetAll()" title="Reset to original">
                    <i class="bi bi-arrow-repeat"></i>
                    <span class="hidden sm:inline">Reset</span>
                </button>

                {{-- Cancel --}}
                <button class="pie-btn pie-btn-ghost" @click="closeEditor()">
                    <i class="bi bi-x-lg"></i>
                    <span class="hidden sm:inline">Cancel</span>
                </button>

                {{-- Apply --}}
                <button class="pie-btn pie-btn-primary" @click="applyAndClose()" :disabled="isProcessing">
                    <template x-if="isProcessing">
                        <i class="bi bi-arrow-repeat animate-spin"></i>
                    </template>
                    <template x-if="!isProcessing">
                        <i class="bi bi-check-lg"></i>
                    </template>
                    <span>Apply</span>
                </button>
            </div>
        </div>

        {{-- ═══ BODY ═══ --}}
        <div class="pie-body pie-animate-in">

            {{-- ── Sidebar Tools ── --}}
            <div class="pie-sidebar">
                {{-- Crop --}}
                <button class="pie-tool-btn" :class="{ active: activeTool === 'crop' }" @click="setTool('crop')" title="Crop">
                    <i class="bi bi-crop"></i>
                    <span>Crop</span>
                </button>

                {{-- Transform --}}
                <button class="pie-tool-btn" :class="{ active: activeTool === 'transform' }" @click="setTool('transform')" title="Transform">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Rotate</span>
                </button>

                <div class="pie-sidebar-divider"></div>

                {{-- Adjust --}}
                <button class="pie-tool-btn" :class="{ active: activeTool === 'adjust' }" @click="setTool('adjust')" title="Adjustments">
                    <i class="bi bi-sun"></i>
                    <span>Adjust</span>
                </button>

                {{-- Filter --}}
                <button class="pie-tool-btn" :class="{ active: activeTool === 'filter' }" @click="setTool('filter')" title="Filters">
                    <i class="bi bi-magic"></i>
                    <span>Filter</span>
                </button>
            </div>

            {{-- ── Canvas Area ── --}}
            <div class="pie-canvas-area" x-ref="canvasArea">
                <div class="pie-canvas-wrapper" x-ref="canvasWrapper">
                    <canvas x-ref="editorCanvas"></canvas>

                    {{-- Crop Overlay --}}
                    <template x-if="isCropping && cropStarted">
                        <div class="pie-crop-overlay" x-ref="cropOverlay"
                             :style="`width: ${canvasWidth}px; height: ${canvasHeight}px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);`">

                            {{-- Crop Box --}}
                            <div class="pie-crop-box"
                                 :style="`left: ${cropBox.x}px; top: ${cropBox.y}px; width: ${cropBox.w}px; height: ${cropBox.h}px;`"
                                 @mousedown="onCropMouseDown($event, 'move')"
                                 @touchstart="onCropTouchStart($event, 'move')">

                                {{-- Resize Handles --}}
                                <div class="pie-crop-handle tl" @mousedown.stop="onCropMouseDown($event, 'tl')" @touchstart.stop="onCropTouchStart($event, 'tl')"></div>
                                <div class="pie-crop-handle tr" @mousedown.stop="onCropMouseDown($event, 'tr')" @touchstart.stop="onCropTouchStart($event, 'tr')"></div>
                                <div class="pie-crop-handle bl" @mousedown.stop="onCropMouseDown($event, 'bl')" @touchstart.stop="onCropTouchStart($event, 'bl')"></div>
                                <div class="pie-crop-handle br" @mousedown.stop="onCropMouseDown($event, 'br')" @touchstart.stop="onCropTouchStart($event, 'br')"></div>

                                {{-- Size Label --}}
                                <div class="pie-crop-size-label" x-text="cropDisplayInfo"></div>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Zoom Controls --}}
                <div class="pie-zoom-controls">
                    <button class="pie-btn-icon" @click="zoomOut()" style="width:28px;height:28px;font-size:12px;">
                        <i class="bi bi-dash"></i>
                    </button>
                    <span class="pie-zoom-label" x-text="zoom + '%'"></span>
                    <button class="pie-btn-icon" @click="zoomIn()" style="width:28px;height:28px;font-size:12px;">
                        <i class="bi bi-plus"></i>
                    </button>
                    <button class="pie-btn-icon" @click="zoomReset()" style="width:28px;height:28px;font-size:10px;" title="Reset Zoom">
                        <i class="bi bi-fullscreen"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- ═══ BOTTOM CONTROLS ═══ --}}
        <div class="pie-controls pie-animate-in">

            {{-- ── CROP Controls ── --}}
            <template x-if="activeTool === 'crop'">
                <div class="pie-controls-group" style="width:100%;gap:16px;">
                    <span class="pie-controls-label">Ratio</span>
                    <div class="pie-ratio-group">
                        <template x-for="r in ['free', '1:1', '16:9', '4:3', '9:16']" :key="r">
                            <button class="pie-ratio-btn" :class="{ active: cropRatio === r }" @click="setCropRatio(r)" x-text="r === 'free' ? 'Free' : r"></button>
                        </template>
                    </div>
                    <div style="flex:1;"></div>
                    <template x-if="cropStarted">
                        <div class="pie-header-actions">
                            <button class="pie-btn pie-btn-ghost" @click="cancelCrop()">
                                <i class="bi bi-x"></i> Cancel
                            </button>
                            <button class="pie-btn pie-btn-primary" @click="applyCrop()" :disabled="isProcessing">
                                <i class="bi bi-check-lg"></i> Apply Crop
                            </button>
                        </div>
                    </template>
                </div>
            </template>

            {{-- ── TRANSFORM Controls ── --}}
            <template x-if="activeTool === 'transform'">
                <div class="pie-controls-group" style="width:100%;gap:12px;">
                    <span class="pie-controls-label">Transform</span>
                    <div class="pie-quick-actions">
                        <button class="pie-quick-btn" @click="rotateCCW()" :disabled="isProcessing">
                            <i class="bi bi-arrow-counterclockwise"></i> -90°
                        </button>
                        <button class="pie-quick-btn" @click="rotateCW()" :disabled="isProcessing">
                            <i class="bi bi-arrow-clockwise"></i> +90°
                        </button>
                        <button class="pie-quick-btn" @click="rotate180()" :disabled="isProcessing">
                            <i class="bi bi-arrow-repeat"></i> 180°
                        </button>
                        <div style="width:1px;height:24px;background:rgba(255,255,255,0.08);"></div>
                        <button class="pie-quick-btn" @click="doFlipH()" :disabled="isProcessing">
                            <i class="bi bi-symmetry-vertical"></i> Flip H
                        </button>
                        <button class="pie-quick-btn" @click="doFlipV()" :disabled="isProcessing">
                            <i class="bi bi-symmetry-horizontal"></i> Flip V
                        </button>
                    </div>
                </div>
            </template>

            {{-- ── ADJUST Controls ── --}}
            <template x-if="activeTool === 'adjust'">
                <div style="width:100%;display:flex;flex-direction:column;gap:8px;">
                    {{-- Brightness --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-brightness-high"></i> Bright</span>
                        <input type="range" class="pie-slider" min="0" max="200" x-model.number="brightness" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="brightness + '%'"></span>
                    </div>
                    {{-- Contrast --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-circle-half"></i> Contrast</span>
                        <input type="range" class="pie-slider" min="0" max="200" x-model.number="contrast" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="contrast + '%'"></span>
                    </div>
                    {{-- Saturation --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-droplet-half"></i> Saturate</span>
                        <input type="range" class="pie-slider" min="0" max="200" x-model.number="saturation" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="saturation + '%'"></span>
                    </div>
                    {{-- Hue Rotate --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-palette2"></i> Hue</span>
                        <input type="range" class="pie-slider" min="0" max="360" x-model.number="hueRotate" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="hueRotate + '°'"></span>
                    </div>
                    {{-- Apply Adjustments Button --}}
                    <div style="display:flex;justify-content:flex-end;margin-top:4px;" x-show="hasChanges">
                        <button class="pie-btn pie-btn-primary" @click="applyAdjustments()" :disabled="isProcessing" style="font-size:11px;padding:6px 14px;">
                            <i class="bi bi-check-lg"></i> Flatten Adjustments
                        </button>
                    </div>
                </div>
            </template>

            {{-- ── FILTER Controls ── --}}
            <template x-if="activeTool === 'filter'">
                <div style="width:100%;display:flex;flex-direction:column;gap:8px;">
                    {{-- Grayscale --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-circle"></i> Gray</span>
                        <input type="range" class="pie-slider" min="0" max="100" x-model.number="grayscale" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="grayscale + '%'"></span>
                    </div>
                    {{-- Sepia --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-image"></i> Sepia</span>
                        <input type="range" class="pie-slider" min="0" max="100" x-model.number="sepia" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="sepia + '%'"></span>
                    </div>
                    {{-- Invert --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-toggles"></i> Invert</span>
                        <input type="range" class="pie-slider" min="0" max="100" x-model.number="invert" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="invert + '%'"></span>
                    </div>
                    {{-- Blur --}}
                    <div style="display:flex;align-items:center;gap:12px;">
                        <span class="pie-controls-label"><i class="bi bi-droplet"></i> Blur</span>
                        <input type="range" class="pie-slider" min="0" max="20" step="0.5" x-model.number="blur" @input="onAdjustmentChange()">
                        <span class="pie-controls-value" x-text="blur + 'px'"></span>
                    </div>
                    {{-- Apply Filters Button --}}
                    <div style="display:flex;justify-content:flex-end;margin-top:4px;" x-show="hasChanges">
                        <button class="pie-btn pie-btn-primary" @click="applyAdjustments()" :disabled="isProcessing" style="font-size:11px;padding:6px 14px;">
                            <i class="bi bi-check-lg"></i> Flatten Filters
                        </button>
                    </div>
                </div>
            </template>

            {{-- ── Info Bar ── --}}
            <div class="pie-info-bar">
                <div class="pie-info-tag">
                    <i class="bi bi-aspect-ratio"></i>
                    <span x-text="dimensionInfo"></span>
                </div>
                <div class="pie-info-tag">
                    <i class="bi bi-clock-history"></i>
                    <span x-text="(historyIndex + 1) + '/' + history.length"></span>
                </div>
            </div>
        </div>

    </div>
</template>
