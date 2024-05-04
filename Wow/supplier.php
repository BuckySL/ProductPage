<?php

    @include 'supplierConfig.php';

    if(isset($_POST['add_sup'])){

        $p_name = $_POST['p_name'];
        $p_desc = $_POST['p_desc']; 
        $p_image= $_FILES['p_img']['name'];
        $p_image_tmp_name = $_FILES['p_img']['tmp_name'];
        $p_image_folder = 'uploaded_img/'.$p_image;

        $insert_query = mysqli_query($conn, "INSERT INTO `suppliers` (name, description, image) VALUES
        ('$p_name', '$p_desc', '$p_image')") or die('query failed');

        if($insert_query){
            move_uploaded_file($p_image_tmp_name, $p_image_folder);
            $message[] = 'Supplier added successfully!';
        }else{
            $message[] = 'Failed to Supplier! Please try again later.';
        }

    };

    

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM `suppliers` WHERE id = $delete_id ") or die('query failed');
        if($delete_query){
           header('location:supplier.php');
           $message[] = 'Supplier has been deleted';
        }else{
           header('location:supplier.php');
           $message[] = 'Supplier could not be deleted';
        };
     };
    

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Admin</title>
    
    <!--font awesome link-->
    <link rel="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 

    <!--css link-->
    <link rel="stylesheet" type="text/css" href="style.css">

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
@include 'supplierHead.php';
?> 

<div class="container">
    <section>
        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>Add a new Supplier</h3>
            
            <input type="text" name="p_name" placeholder="Enter the supplier name" class="box" required>
            <input type="text" name="p_desc" placeholder="Enter the supplier Description" class="box" required>
            <input type="file" name="p_img" accept ="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value ="add Supplier details"  name ="add_sup" class="btn">

        </form>
   
    </section>

    <section class= "display-product-table">
        <table>
            <thead>
                <th>Supplier Brand image</th>
                <th>Supplier name</th>
                <th>Supplier description</th>
                <th>Action</th>
            </thead>

            <tbody>
                <?php 
                
                $select_products = mysqli_query($conn, "SELECT * FROM `suppliers`");
                if(mysqli_num_rows( $select_products) >0){
                    while($row = mysqli_fetch_assoc( $select_products)){
                ?>
            <tr>
                <td><img src="uploaded_img/<?php echo $row['image'];?>" height="100" alt=""></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td>
                    <a href="supplier.php?delete=<?php echo $row['id']; ?>" class="delete-btn" 
                    onclick="return confirm('are you sure you want to delete this?');"><i class="fas fa-trash"></i> Delete</a>
                    <a href="supplier.php?edit=<?php echo $row[ 'id']?>" class="option-btn"><i class ="fas fa-edit"></i>Update</a>
                </td>
            </tr>



                <?php
                     };

                    }else{

                        echo"<div class='empty'>No Supplier/s has been added</div>";
                    };
                
                ?>
            </tbody>
        </table>

    </section>



</div>


  
      





<script src="js/script.js"></script>


</body>
</html>