
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $books['judul']?></h1>
      </div>

      <div class="table-responsive">
       <img src = "<?php echo "/books/assets/images/" .$books['imgfile']; ?>">

        <table class="table table-striped table-sm">
          <thead>
            <tr>
            	<th>ID Buku</th>
            	<th>Judul Buku</th>
              	<th>Pengarang</th>
              	<th>Penerbit</th>
              	<th>Tahun Terbit</th>
              	<th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            	<td><?php echo $books['idbuku']?></td>
            	<td><?php echo $books['judul']?></td>
        	    <td><?php echo $books['pengarang']?></td>
            	<td><?php echo $books['penerbit']?></td>
              	<td><?php echo $books['thnterbit']?></td>
              	<td><?php echo $books['idkategori']?></td>
            </tr>
          </tbody>
        </table>
        	<h3>Sinopsis</h3>
        	<p><?php echo $books['sinopsis']?></p>
      </div>
    </main>
  