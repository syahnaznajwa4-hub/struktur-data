<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisasi Struktur Data Linear</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<!-- Navbar / Menu Atas -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-diagram-3"></i> DataStructure Lab</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="array.php">Array</a>
            <a class="nav-link" href="linkedlist.php">Linked List</a>
            <a class="nav-link" href="stack.php">Stack</a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
        <div class="container-fluid py-2">
            <h1 class="display-5 fw-bold text-primary">Simulasi Struktur Data Linear</h1>
            <p class="col-md-8 fs-5 text-muted">Aplikasi web interaktif sederhana menggunakan PHP untuk memvisualisasikan operasi dasar pada Array, Linked List, dan Stack.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Card 1: Array -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="text-primary mb-3"><i class="bi bi-grid-3x3-gap-fill fs-1"></i></div>
                    <h5 class="card-title fw-bold">1. Array</h5>
                    <p class="card-text text-muted">Kumpulan elemen yang disimpan secara berurutan dalam memori teralokasi dengan indeks tetap.</p>
                    <a href="array.php" class="btn btn-outline-primary w-100">Coba Array Demo &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card 2: Linked List -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="text-success mb-3"><i class="bi bi-link-45deg fs-1"></i></div>
                    <h5 class="card-title fw-bold">2. Linked List</h5>
                    <p class="card-text text-muted">Elemen (Node) yang saling terhubung menggunakan pointer (`next`), alokasi memori dinamis.</p>
                    <a href="linkedlist.php" class="btn btn-outline-success w-100">Coba Linked List Demo &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card 3: Stack -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="text-warning mb-3"><i class="bi bi-layers-fill fs-1"></i></div>
                    <h5 class="card-title fw-bold">3. Stack</h5>
                    <p class="card-text text-muted">Struktur data LIFO (Last In First Out). Penambahan dan penghapusan dilakukan di satu ujung (Top).</p>
                    <a href="stack.php" class="btn btn-outline-warning w-100">Coba Stack Demo &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-4 text-muted border-top bg-white mt-auto">
    <p class="mb-0">Project Demonstrasi Struktur Data Linear &copy; PHP & Bootstrap 5</p>
</footer>

</body>
</html>