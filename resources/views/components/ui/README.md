# UI Components - SweetAlert & Toast

Komponen UI premium dengan integrasi **Tema Warna** dan **Dark/Light Mode**.

> **📦 Update**: Alert Confirmation sekarang menggunakan **SweetAlert2** untuk tampilan yang lebih modern dan keren!

---

## 🔔 Toast Notifications

### Basic Usage

Toast sudah tersedia secara global di layout. Gunakan dengan Alpine.js events:

```javascript
// Success Toast
$dispatch('toast-success', { 
    message: 'Data berhasil disimpan!',
    title: 'Sukses' // optional
})

// Error Toast
$dispatch('toast-error', { 
    message: 'Terjadi kesalahan!',
    title: 'Error' // optional
})

// Warning Toast
$dispatch('toast-warning', { 
    message: 'Harap periksa kembali data Anda',
    title: 'Peringatan' // optional
})

// Info Toast
$dispatch('toast-info', { 
    message: 'Proses sedang berjalan...',
    title: 'Info' // optional
})
```

### Advanced Toast Options

```javascript
// Custom duration (in milliseconds)
$dispatch('toast', { 
    type: 'success',
    message: 'Berhasil!',
    title: 'Custom Duration',
    duration: 10000  // 10 seconds
})

// Permanent toast (duration: 0)
$dispatch('toast', { 
    type: 'info',
    message: 'Toast ini tidak akan hilang otomatis',
    duration: 0
})

// Clear all toasts
$dispatch('clear-toasts')
```

### Example in Blade

```html
<button 
    @click="$dispatch('toast-success', { 
        message: 'Item berhasil ditambahkan!', 
        title: 'Berhasil' 
    })"
    class="btn-premium px-4 py-2 rounded-lg text-white"
>
    Show Success Toast
</button>
```

---

## ⚠️ SweetAlert Confirmation Dialog

### Basic Usage

SweetAlert sudah tersedia secara global dengan id `global-confirm`. Gunakan dengan events:

```javascript
// Open confirmation dialog
$dispatch('swal-confirm-global-confirm', {
    title: 'Hapus Item?',
    message: 'Apakah Anda yakin ingin menghapus item ini?',
    type: 'danger',  // warning, danger, info, success, question
    confirmText: 'Ya, Hapus',
    cancelText: 'Batal',
    onConfirm: () => {
        // Action when confirmed
        $dispatch('toast-success', { message: 'Item berhasil dihapus!' })
    },
    onCancel: () => {
        // Action when cancelled (optional)
        console.log('Cancelled')
    }
})
```

### Dialog Types

| Type | Icon | Usage |
|------|------|-------|
| `warning` | ⚠️ Warning | Default, untuk konfirmasi umum |
| `danger` | ❌ Error | Untuk aksi destruktif (hapus, remove) |
| `success` | ✅ Success | Untuk konfirmasi positif |
| `info` | ℹ️ Info | Untuk konfirmasi informatif |
| `question` | ❓ Question | Untuk pertanyaan |

### Example: Delete Confirmation

```html
<button 
    @click="$dispatch('swal-confirm-global-confirm', {
        title: 'Hapus Pengguna?',
        message: 'Pengguna ini akan dihapus secara permanen dan tidak dapat dikembalikan.',
        type: 'danger',
        confirmText: 'Ya, Hapus Sekarang',
        cancelText: 'Batalkan',
        onConfirm: () => {
            // Call your delete function here
            deleteUser(userId);
            $dispatch('toast-success', { message: 'Pengguna berhasil dihapus' });
        }
    })"
    class="text-red-500 hover:text-red-700"
>
    <i class="bi bi-trash"></i> Hapus
</button>
```

### Example: Save Confirmation

```html
<button 
    @click="$dispatch('swal-confirm-global-confirm', {
        title: 'Simpan Perubahan?',
        message: 'Perubahan pengaturan akan langsung diterapkan ke seluruh website.',
        type: 'info',
        confirmText: 'Simpan',
        cancelText: 'Tinjau Ulang',
        onConfirm: () => {
            saveSettings();
            $dispatch('toast-success', { message: 'Pengaturan berhasil disimpan!' });
        }
    })"
    class="btn-premium text-white px-6 py-2 rounded-lg"
>
    Simpan Pengaturan
</button>
```

### Example: With Livewire

```html
<button 
    @click="$dispatch('swal-confirm-global-confirm', {
        title: 'Simpan Data?',
        message: 'Data yang diubah akan disimpan ke database.',
        type: 'success',
        confirmText: 'Simpan',
        cancelText: 'Batal',
        onConfirm: () => {
            $wire.save();  // Panggil method Livewire
        }
    })"
    class="btn-premium text-white px-6 py-3 rounded-xl"
>
    Simpan
</button>
```

---

## 🎨 Theme Integration

Kedua komponen terintegrasi dengan sistem tema:

- **Dark/Light Mode**: Otomatis menyesuaikan dengan mode tema aktif
- **Custom Styling**: SweetAlert memiliki styling kustom yang match dengan tema
- **Smooth Animations**: Animasi yang halus untuk pengalaman premium

---

## 📦 Custom Instance

Jika perlu instance terpisah:

```html
<!-- Custom Toast Position -->
<x-ui.toast position="bottom-left" :duration="3000" :maxToasts="3" />

<!-- Custom SweetAlert with Different ID -->
<x-ui.sweet-alert id="delete-confirm" />

<!-- Trigger custom alert -->
<button @click="$dispatch('swal-confirm-delete-confirm', { ... })">
    Delete
</button>
```

### Available Positions for Toast

- `top-right` (default)
- `top-left`
- `top-center`
- `bottom-right`
- `bottom-left`
- `bottom-center`

---

## 🚀 SweetAlert Features

SweetAlert2 menyediakan fitur-fitur berikut:

- ✅ Animasi yang smooth dan modern
- ✅ Dukungan dark/light mode otomatis
- ✅ Icon yang menarik untuk setiap tipe
- ✅ Backdrop blur untuk fokus
- ✅ Keyboard navigation (Enter & Escape)
- ✅ Click outside to close
- ✅ Customizable button colors
- ✅ Responsive design
