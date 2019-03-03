<style>
.progress {
    display: block;
    text-align: center;
    width: 0;
    height: 3px;
    background: #4a6fdc;
    transition: width .3s;
}
.progress.hide {
    opacity: 0;
    transition: opacity 1.3s;
}
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <input type="text" class="form-control" name="id" id="id" placeholder="Masukan Kata Kunci ...">
            <div class="d-flex justify-content-center" style="margin: 8px;">
                <button class="btn btn-primary" style="width: 50%">Cari</button>
            </div>
        </div>
    </div>
</div>