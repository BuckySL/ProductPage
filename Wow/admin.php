<?php

    @include 'config.php';

    if(isset($_POST['add_product'])){

        $p_name = $_POST['p_name'];
        $p_number = $_POST['p_number'];
        $p_desc = $_POST['p_desc']; 
        $p_image= $_FILES['p_img']['name'];
        $p_image_tmp_name = $_FILES['p_img']['tmp_name'];
        $p_image_folder = 'uploaded_img/'.$p_image;

        $insert_query = mysqli_query($conn, "INSERT INTO `products` (name, price, description, image) VALUES
        ('$p_name', '$p_number', '$p_desc', '$p_image')") or die('query failed');

        if($insert_query){
            move_uploaded_file($p_image_tmp_name, $p_image_folder);
            $message[] = 'Product added successfully!';
        }else{
            $message[] = 'Failed to add product! Please try again later.';
        }

    };

    

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
        if($delete_query){
           //header('location:admin.php');
           $message[] = 'product has been deleted';
        }else{
           //header('location:admin.php');
           $message[] = 'product could not be deleted';
        };
     };
    
     if(isset($_POST['update_product'])){
        $update_p_id = $_POST['update_p_id'];
        $update_p_name = $_POST['update_p_name'];
        $update_p_price = $_POST['update_p_price'];
        $update_p_des = $_POST['update_p_des'];
        $update_p_image = $_FILES['update_p_image']['name'];
        $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
        $update_p_image_folder = 'uploaded_img/'.$update_p_image;
     
        $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price',description='$update_p_des', image = '$update_p_image' WHERE id = '$update_p_id'");
     
        if($update_query){
           move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
           $message[] = 'product updated succesfully';
           header('location:admin.php');
        }else{
           $message[] = 'product could not be updated';
           header('location:admin.php');
        }
     
     }

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Admin</title>
    
    <!--font awesome link-->
    <link rel="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 

    <!--css link-->
    <link rel="stylesheet" type="text/css" href="style.css">

    
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Link -->

</head>
<body>
    
<?php

if (isset($message)){
    foreach($message as $message){

        echo '<div class= "message"><span>'. $message .'</span> <i class="fas fa-times" onclick= "this.parentElement.style.display = `none`;"</i></div>';

    }
}else{
    $message = 'Could not add the product';
}


?>


<?php 
 @include 'header.php';
?> 

<div class="container">
    <section>
        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>Add a new Product</h3>
            
            <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
            <input type="number" name="p_number" min="0" placeholder="Enter the product price" class="box" required>
            <input type="text" name="p_desc" placeholder="Enter the product Description" class="box" required>
            <input type="file" name="p_img" accept ="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value ="add the product"  name ="add_product" class="btn">

        </form>
   
    </section>

    <section class= "display-product-table">
        <table>
            <thead>
                <th>Product image</th>
                <th>Product name</th>
                <th>Product price</th>
                <th>Product description</th>
                <th>Action</th>
            </thead>

            <tbody>
                <?php 
                
                $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                if(mysqli_num_rows( $select_products) >0){
                    while($row = mysqli_fetch_assoc( $select_products)){
                ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $row['image'];?>" height="100" alt=""></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["price"]."$"." /="; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" 
                    onclick="return confirm('are you sure you want to delete this?');"><i class="fas fa-trash"></i> Delete</a>
                    <a href="admin.php?edit=<?php echo $row[ 'id']?>" class="option-btn"><i class ="fas fa-edit"></i>Update</a>
                </td>
            </tr>



                <?php
                     };

                    }else{

                        echo"<div class='empty'>No product has been added</div>";
                    };
                
                ?>
            </tbody>
        </table>

    </section>

<section class="edit-form-container">

<?php

if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
   if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
?>

<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
   <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
   <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
   <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
   <input type = "desc" class="box" required name = "update_p_des" value = "<?php echo $fetch_edit['description']; ?>">
   <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
   <input type="submit" value="update the prodcut" name="update_product" class="btn">
   <input type="reset" value="cancel" id="close-edit" class="option-btn">
</form>

<?php
         };
      };

      echo "<script>document.querySelector('.edit-form-container').style.display = 'flex'; 
      document.querySelector('#close-edit').onclick = () =>{
        document.querySelector('.edit-form-container').style.display = 'none';
        window.location.href = 'admin.php';
     };
      </script>";
   };
?>

</section>

    
    

</section>

</div>


  
      





<script src="js/script.js"></script>


</body>
</html>