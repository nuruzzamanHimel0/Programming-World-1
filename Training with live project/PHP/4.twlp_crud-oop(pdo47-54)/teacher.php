<?php include "inc/header.php"; ?>
<?php 
    $path = realpath(dirname(__FILE__));
     include($path."/config/config.php");
     include($path."/lib/Db.php");
?>

<?php
spl_autoload_register(function($class_name){
    include_once("classes/".$class_name.".php");
});
?>
<?php 
    $tcr = new Teacher();
?>

<?php 
    
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $age = $_POST['age'];

        // echo $name." -- ".$dept." -- ".$age;
        // 
        // echo "SUbmitted";

        $insert_data = $tcr->insertData($name,$dept,$age);

        if(isset($insert_data))
        {
            echo $insert_data;
        }
    }
?>

<?php 
    
    if(isset($_POST['update']))
    {
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $age = $_POST['age'];
        $id = $_POST['id'];

        // echo $name." -- ".$dept." -- ".$age;
        // 
        // echo "SUbmitted";

        $update_data = $tcr->updateData($id,$name,$dept,$age);

        if(isset($update_data))
        {
            echo $update_data;
        }
    }
?>

<?php 
if(isset($_GET['action']) && $_GET['action'] === 'delete' )
{

      $id = $_GET['id'];

       $delete_data = $tcr->deleteData($id);

        if(isset($delete_data))
        {
            echo $delete_data;
        }


}

?>


<section class="mainleft">

    <?php 
        if(isset($_GET['action']) && $_GET['action'] === 'edit' )
        {
            $id = (int)$_GET['id'];
            // echo $id;
            $result = $tcr->readById($id);

            if($result != FALSE)
            {
        ?>
                
            <form action="" method="POST">
             <table>
                <tr>
                    <td>Name: </td>
                    <input type="hidden" name="id" value="<?php echo $result["id"]; ?>">
                    <td><input type="text" name="name" value="<?php echo $result['name']; ?>" /></td>    
                </tr>

                <tr>
                   <td>Department: </td>
                    <td><input type="text" name="dept" value="<?php echo $result['dept']; ?>" /> </td>
                </tr>

                <tr>
                  <td>Age: </td>
                    <td><input type="text" name="age" value="<?php echo $result['age']; ?>" /></td>
                </tr>
                <tr>
                  <td></td>
                    <td>
                    <input type="submit" name="update" value="Updated"/>
                    <input type="reset" value="Clear"/>
                    </td>
                </tr>
              </table>
            </form>
        <?php        
            }       
        }else{
    ?>
            
              <form action="" method="POST">
             <table>
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" /></td>    
                </tr>

                <tr>
                   <td>Department: </td>
                    <td><input type="text" name="dept"/> </td>
                </tr>

                <tr>
                  <td>Age: </td>
                    <td><input type="text" name="age"/></td>
                </tr>
                <tr>
                  <td></td>
                    <td>
                    <input type="submit" name="submit" value="Submit"/>
                    <input type="reset" value="Clear"/>
                    </td>
                </tr>
              </table>
            </form>


    <?php

        }
    ?>



</section>



<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Age</th>
        <th>Action</th>
    </tr>
<?php
            $i = 0;
            foreach ($tcr->readAll() as $value)
            {
                $i++;
            ?>
            <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value["name"]; ?></td>
                    <td><?php echo $value["dept"]; ?></td>
                    <td><?php echo $value["age"]; ?></td>
                    <td>
                        <?php echo "<a href='?action=edit&id=".$value["id"]."'>Edit </a>" ?>||
                        <?php echo "<a href='?action=delete&id=".$value["id"]."' > Delete </a>  " ?>
                    </td>
            </tr>
            <?php 
            }
            ?>




   
  </table>
</section>










<?php include "inc/footer.php"; ?>