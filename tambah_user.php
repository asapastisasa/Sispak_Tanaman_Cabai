<?php

if(isset($_POST['simpan'])){

    // mengambil data dari form
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $role=$_POST['role'];
	
	//proses simpan
   $check_sql = "SELECT * FROM user WHERE username='$username'";
   $result = $conn->query($check_sql);

   if ($result->num_rows > 0) {
       echo "<script>alert('Username sudah pernah digunakan');</script>";
   } else {
       //proses simpan
       $sql = "INSERT INTO user VALUES (NULL, '$username', '$pass', '$role')";
       if ($conn->query($sql) === TRUE) {
           header("Location:?page=user");
       } else {
           echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
       }
   }
}
?>
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-success text-white border-dark"><strong>Tambah Data User</strong></div>
                <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" maxlength="25" required
                        oninvalid="this.setCustomValidity('Isi Username')"
                        oninput="this.setCustomValidity('')">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="pass" maxlength="10" required
                        oninvalid="this.setCustomValidity('Isi Password')"
                        oninput="this.setCustomValidity('')">
                </div>                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role" value="Admin" readonly>
                    </div>                
                        <input class="btn btn-success mb-2 " type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger mb-2" href="?page=user">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>