<div class="card">
  <div class="card-header bg-success text-white border-dark"><strong>DATA USER</strong></div>
  <div class="card-body">
    <a class="btn btn-success mb-3" href="?page=user&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="80px">No.</th>
        <th width="200px">Nama User</th>
        <th width="400px">Role</th>
        <th width="100px"></th>
      </tr>
    </thead>
    <tbody>
    <?php
        $no=1;
        $sql = "SELECT*FROM user ORDER BY username ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td align="center">
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=user&action=hapus&id=<?php echo $row['iduser']; ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
         </tr>
    <?php
     }
     $conn->close();
    ?>  
    </tbody>
</table>
</div>
</div>