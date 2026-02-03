# UI Components - Alert Confirm & Toast

Komponen UI premium dengan integrasi **Tema Warna** dan **Dark/Light Mode**.

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

## ⚠️ Alert Confirmation Dialog

### Basic Usage

Alert sudah tersedia secara global dengan id `global-confirm`. Gunakan dengan events:

```javascript
// Open confirmation dialog
$dispatch('open-confirm-global-confirm', {
    title: 'Hapus Item?',
    message: 'Apakah Anda yakin ingin menghapus item ini?',
    type: 'danger',  // warning, danger, info, success
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

// Close dialog programmatically
$dispatch('close-confirm-global-confirm')
```

### Dialog Types

| Type | Icon | Usage |
|------|------|-------|
| `warning` | ⚠️ Exclamation | Default, for general confirmations |
| `danger` | 🗑️ Trash | For destructive actions (delete, remove) |
| `success` | ✅ Checkmark | For positive confirmations |
| `info` | ℹ️ Info | For informational confirmations |

### Example: Delete Confirmation

```html
<button 
    @click="$dispatch('open-confirm-global-confirm', {
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
    @click="$dispatch('open-confirm-global-confirm', {
        title: 'Simpan Perubahan?',
        message: 'Perubahan pengaturan akan langsung diterapkan ke seluruh website.',
        type: 'info',
        confirmText: 'Ya, Simpan',
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

---

## 🎨 Theme Integration

Kedua komponen terintegrasi dengan sistem tema:

- **CSS Variables**: Menggunakan `--gradient-start` dan `--gradient-end` untuk warna tema
- **Dark/Light Mode**: Otomatis menyesuaikan dengan `$root.darkMode`
- **Premium Styling**: Menggunakan class `.btn-premium`, `.glass-card`, dll

---

## 📦 Custom Instance

Jika perlu instance terpisah:

```html
<!-- Custom Toast Position -->
<x-ui.toast position="bottom-left" :duration="3000" :maxToasts="3" />

<!-- Custom Alert with Different ID -->
<x-ui.alert-confirm 
    id="delete-confirm" 
    title="Konfirmasi Hapus"
    type="danger"
/>

<!-- Trigger custom alert -->
<button @click="$dispatch('open-confirm-delete-confirm', { ... })">
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
