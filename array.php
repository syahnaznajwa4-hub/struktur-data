<?php
session_start();

if (!isset($_SESSION['array_data'])) {$_SESSION['array_data'] = ['Apel', 'Jeruk', 'Mangga', 'Pisang'];
}

$message = "";
$highlight_index = -1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action =$_POST['action'] ?? '';

    if ($action === 'add') {
        $val = trim($_POST['value']);
        if (!empty($val)) {
            $_SESSION['array_data'][] =$val;
            $message = "Elemen '$val' berhasil ditambahkan di akhir array.";
        }
    } elseif ($action === 'update') {
        $idx = (int)$_POST['index'];
        $val = trim($_POST['value']);
        if (isset($_SESSION['array_data'][$idx]) && !empty($val)) {$_SESSION['array_data'][$idx] =$val;
            $message = "Elemen pada indeks [$idx] diperbarui menjadi '$val'.";
        }
    } elseif ($action === 'delete') {
        $idx = (int)$_POST['index'];
        if (isset($_SESSION['array_data'][$idx])) {$removed = $_SESSION['array_data'][$idx];
            array_splice($_SESSION['array_data'], $idx, 1);$message = "Elemen '$removed' pada indeks [$idx] berhasil dihapus.";
        }
    } elseif ($action === 'search') {$search = trim($_POST['search_val']);$found = array_search($search,$_SESSION['array_data']);
        if ($found !== false) {
            $highlight_index =$found;
            $message = "Elemen '$search' ditemukan pada **Indeks [$found]**!";
        } else {
            $message = "Elemen '$search' tidak ditemukan dalam Array.";
        }
    } elseif ($action === 'reset') {
        $_SESSION['array_data'] = ['Apel', 'Jeruk', 'Mangga', 'Pisang'];$message = "Array di-reset ke data awal.";
    }
}

include 'includes/header.php';
?>

<h2 class="mb-3"><i class="bi bi-grid-3x3-gap-fill text-primary"></i> Demonstrasi Array Linear</h2>
<p class="text-muted">Array menyimpan elemen dalam urutan berkode indeks mulai dari `0` hingga `N-1`.</p>

<?php if ($message): ?>
    <div class="alert alert-info alert-dismissible fade show"><?= $message ?></div>
<?php endif; ?>

<!-- Visualisasi Array -->
<div class="card p-4 mb-4 shadow-sm">
    <h5 class="card-title text-center mb-3">Tampilan Array Saat Ini</h5>
    <div class="d-flex flex-wrap justify-content-center gap-3 py-3">
        <?php if (empty($_SESSION['array_data'])): ?>
            <p class="text-muted"><i>Array kosong.</i></p>
        <?php else: ?>
            <?php foreach ($_SESSION['array_data'] as $idx =>$item): ?>
                <div class="text-center">
                    <div class="data-box border border-2 <?= ($idx ===$highlight_index) ? 'bg-warning text-dark border-dark fw-bold scale-110' : 'bg-primary text-white border-primary' ?>">
                        <?= htmlspecialchars($item) ?>
                    </div>
                    <small class="text-muted d-block mt-1">Indeks [<?= $idx ?>]</small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Form Kontrol -->
<div class="row g-3">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
            <h6>Tambah Elemen (Append)</h6>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <div class="input-group mb-2">
                    <input type="text" name="value" class="form-control" placeholder="Nilai baru" required>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
            <h6>Cari / Highlight Elemen</h6>
            <form method="POST">
                <input type="hidden" name="action" value="search">
                <div class="input-group mb-2">
                    <input type="text" name="search_val" class="form-control" placeholder="Nama elemen" required>
                    <button class="btn btn-warning" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm h-100">
            <h6>Hapus berdasarkan Indeks</h6>
            <form method="POST">
                <input type="hidden" name="action" value="delete">
                <div class="input-group mb-2">
                    <input type="number" name="index" class="form-control" placeholder="No. Indeks" min="0" required>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form method="POST" class="mt-3 text-end">
    <input type="hidden" name="action" value="reset">
    <button type="submit" class="btn btn-outline-secondary btn-sm">Reset Array</button>
</form>

<?php include 'includes/footer.php'; ?>