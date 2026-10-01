<?php
session_start();
require_once 'classes/Stack.php';

if (!isset($_SESSION['stack_data'])) {
    $stack = new Stack(6); // Limit 6 elemen
    $stack->push("Piring 1");
    $stack->push("Piring 2");
    $stack->push("Piring 3");
    $_SESSION['stack_data'] = serialize($stack);
}

$stack = unserialize($_SESSION['stack_data']);
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'push') {
        $val = trim($_POST['value']);
        if (!empty($val)) {
            if ($stack->push($val)) {
                $message = "Berhasil memasukkan '$val' ke Stack (PUSH).";
            } else {
                $message = "<strong class='text-danger'>Stack Overflow!</strong> Batas kapasitas tumpukan telah tercapai.";
            }
        }
    } elseif ($action === 'pop') {
        $popped = $stack->pop();
        if ($popped !== null) {
            $message = "Berhasil mengeluarkan elemen paling atas: '<strong>$popped</strong>' (POP).";
        } else {
            $message = "<strong class='text-danger'>Stack Underflow!</strong> Stack saat ini kosong.";
        }
    } elseif ($action === 'reset') {
        $stack = new Stack(6);
        $stack->push("Piring 1");
        $stack->push("Piring 2");
        $stack->push("Piring 3");
        $message = "Stack di-reset.";
    }

    $_SESSION['stack_data'] = serialize($stack);
}

$items = $stack->getItems();
$topItem = $stack->peek();
include 'includes/header.php';
?>

<h2 class="mb-3"><i class="bi bi-layers-fill text-warning"></i> Demonstrasi Stack (LIFO)</h2>
<p class="text-muted">Prinsip **LIFO** (Last-In, First-Out). Elemen terakhir yang ditambahkan akan menjadi elemen pertama yang dikeluarkan.</p>

<?php if ($message): ?>
    <div class="alert alert-warning alert-dismissible fade show"><?= $message ?></div>
<?php endif; ?>

<div class="row">
    <!-- Visualisasi Tumpukan (Stack) -->
    <div class="col-md-6 offset-md-3">
        <div class="card p-4 shadow-sm mb-4">
            <h5 class="card-title text-center mb-3">Tumpukan Visual (TOP &rarr; Bottom)</h5>
            
            <div class="d-flex flex-column align-items-center gap-2 border-bottom border-start border-end border-3 border-dark p-3 rounded-bottom bg-light" style="min-height: 250px; justify-content: flex-end;">
                <?php if (empty($items)): ?>
                    <p class="text-muted my-auto"><i>Stack Kosong (Underflow)</i></p>
                <?php else: ?>
                    <!-- Render terbalik agar TOP berada paling atas secara visual -->
                    <?php 
                    $reversedItems = array_reverse($items); 
                    foreach ($reversedItems as $index => $item): 
                        $isTop = ($item === $topItem);
                    ?>
                        <div class="w-70 text-center py-2 px-4 rounded fw-bold shadow-sm transition <?= $isTop ? 'bg-warning text-dark border border-2 border-dark' : 'bg-secondary text-white' ?>" style="width: 80%;">
                            <?= htmlspecialchars($item) ?>
                            <?php if ($isTop): ?>
                                <span class="badge bg-dark ms-2">&larr; TOP</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <p class="text-center text-muted small mt-2 mb-0">Dasar Tumpukan (Bottom)</p>
        </div>
    </div>
</div>

<!-- Tombol Kontrol Push & Pop -->
<div class="row justify-content-center g-3">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Operasi PUSH (Tambah)</h6>
            <form method="POST">
                <input type="hidden" name="action" value="push">
                <div class="input-group">
                    <input type="text" name="value" class="form-control" placeholder="Nama Item" required>
                    <button class="btn btn-warning fw-bold" type="submit">PUSH</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card p-3 shadow-sm text-center">
            <h6>Operasi POP (Hapus Top)</h6>
            <form method="POST">
                <input type="hidden" name="action" value="pop">
                <button class="btn btn-danger w-100 fw-bold" type="submit" <?= empty($items) ? 'disabled' : '' ?>>
                    POP (Keluarkan TOP)
                </button>
            </form>
        </div>
    </div>
</div>

<form method="POST" class="mt-4 text-center">
    <input type="hidden" name="action" value="reset">
    <button type="submit" class="btn btn-outline-secondary btn-sm">Reset Stack</button>
</form>

<?php include 'includes/footer.php'; ?>