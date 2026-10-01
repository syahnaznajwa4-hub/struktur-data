<?php
session_start();
require_once 'classes/LinkedList.php';

if (!isset($_SESSION['linked_list'])) {
    $list = new LinkedList();
    $list->insertAtEnd("Node A");
    $list->insertAtEnd("Node B");
    $list->insertAtEnd("Node C");
    $_SESSION['linked_list'] = serialize($list);
}

$list = unserialize($_SESSION['linked_list']);
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $val = trim($_POST['value'] ?? '');

    if ($action === 'insert_first' && !empty($val)) {
        $list->insertAtBeginning($val);
        $message = "Node '$val' ditambahkan di Awal (Head).";
    } elseif ($action === 'insert_last' && !empty($val)) {
        $list->insertAtEnd($val);
        $message = "Node '$val' ditambahkan di Akhir (Tail).";
    } elseif ($action === 'delete' && !empty($val)) {
        if ($list->delete($val)) {
            $message = "Node '$val' berhasil dihapus dari Linked List.";
        } else {
            $message = "Node '$val' tidak ditemukan.";
        }
    } elseif ($action === 'reset') {
        $list = new LinkedList();
        $list->insertAtEnd("Node A");
        $list->insertAtEnd("Node B");
        $list->insertAtEnd("Node C");
        $message = "Linked List di-reset.";
    }

    $_SESSION['linked_list'] = serialize($list);
}

$nodes = $list->toArray();
include 'includes/header.php';
?>

<h2 class="mb-3"><i class="bi bi-link-45deg text-success"></i> Demonstrasi Singly Linked List</h2>
<p class="text-muted">Linked List terdiri dari Node yang terhubung via Pointer. Urutannya dinamis dan tidak terikat lokasi memori fisik berturut-turut.</p>

<?php if ($message): ?>
    <div class="alert alert-success alert-dismissible fade show"><?= $message ?></div>
<?php endif; ?>

<!-- Visualisasi Linked List -->
<div class="card p-4 mb-4 shadow-sm">
    <h5 class="card-title text-center mb-4">Struktur Visual Linked List</h5>
    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 py-3">
        <?php if (empty($nodes)): ?>
            <span class="badge bg-secondary p-3">HEAD = NULL (Kosong)</span>
        <?php else: ?>
            <span class="badge bg-dark p-2 me-2">HEAD</span>
            <?php foreach ($nodes as $index => $data): ?>
                <div class="border border-success rounded p-2 bg-light d-flex align-items-center shadow-sm">
                    <div class="bg-success text-white px-3 py-2 rounded-start fw-bold">
                        <?= htmlspecialchars($data) ?>
                    </div>
                    <div class="bg-white text-dark px-2 py-2 rounded-end border-start small text-muted">
                        next &rarr;
                    </div>
                </div>
                
                <?php if ($index < count($nodes) - 1): ?>
                    <span class="pointer-arrow">&rarr;</span>
                <?php else: ?>
                    <span class="pointer-arrow">&rarr;</span>
                    <span class="badge bg-danger p-2">NULL</span>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Form Interaksi -->
<div class="row g-3">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Tambah di Awal (Head)</h6>
            <form method="POST">
                <input type="hidden" name="action" value="insert_first">
                <div class="input-group mb-2">
                    <input type="text" name="value" class="form-control" placeholder="Nama Node" required>
                    <button class="btn btn-success" type="submit">Prepend</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Tambah di Akhir (Tail)</h6>
            <form method="POST">
                <input type="hidden" name="action" value="insert_last">
                <div class="input-group mb-2">
                    <input type="text" name="value" class="form-control" placeholder="Nama Node" required>
                    <button class="btn btn-outline-success" type="submit">Append</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3 shadow-sm">
            <h6>Hapus Node</h6>
            <form method="POST">
                <input type="hidden" name="action" value="delete">
                <div class="input-group mb-2">
                    <input type="text" name="value" class="form-control" placeholder="Nilai Node" required>
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form method="POST" class="mt-3 text-end">
    <input type="hidden" name="action" value="reset">
    <button type="submit" class="btn btn-outline-secondary btn-sm">Reset Linked List</button>
</form>

<?php include 'includes/footer.php'; ?>