<?php 
    // تحديد معلومات قاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myproject";

    // إنشاء اتصال بقاعدة البيانات
    $conn =mysqli_connect($servername, $username, $password, $dbname);

    // التحقق من وجود اتصال صحيح
    if (mysqli_error($conn)) {
        die("Connection failed: " . mysqli_error($conn));
    }    


    //كود حفظ البيانات إلى قاعدة البيانات
    if (isset($_POST['save'])){
        
        // استلام البيانات من النموذج HTML
        $product_name = $_POST['product-name'];
        $product_description = $_POST['product-description'];


        // تحميل الصورة
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["product-image"]["name"]);
        move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file);
        
        
        // إدخال البيانات في جدول قاعدة البيانات
        $sql = "INSERT INTO products (name, text, image)
        VALUES ('$product_name', '$product_description','$target_file')";



        if (mysqli_query($conn,$sql)) {
                header('location:dashboard.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }



    // حذف البيانات إذا تم تقديم النموذج
    if (isset($_POST['delete'])) {
    
        $id = $_POST["id"];

        // حذف الصورة القديمة
        $sql_select = "SELECT image FROM products WHERE id=$id";
        $result = mysqli_query($conn,$sql_select);
        if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $old_image = $row["image"];
        unlink($old_image);
        }

        // إعداد استعلام SQL لحذف البيانات
        $sql = "DELETE FROM products WHERE id = $id";

        if (mysqli_query($conn,$sql)) {
            header("location:dashboard.php");
        } else {
        echo "حدث خطأ أثناء حذف البيانات: " . mysqli_error($conn);
        }
    }

    if(isset($_POST['update'])){
        $id=$_POST['id'];

        header("location:dashboard.php?id=$id");
    }

    // تحديث البيانات إذا تم تقديم النموذج
    if (isset($_POST['save_edit'])) {
        $id = $_POST["id"];
        $product_name = $_POST['product-name'];
        $product_description = $_POST['product-description'];
        
        

        // إعداد استعلام SQL لتحديث البيانات
        if(!empty($_FILES['product-image']['tmp_name'])){
            // حذف الصورة القديمة
            $sql_select = "SELECT image FROM products WHERE id=$id";
            $result = mysqli_query($conn,$sql_select);
            if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);
            $old_image = $row["image"];
            unlink($old_image);
            }
            
            // تحميل الصورة الجديدة وحفظها في مجلد الصور
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["product-image"]["name"]);
            move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file);
            $image = $target_file;

            $sql = "UPDATE products SET name='$product_name', text='$product_description', image='$image' WHERE id=$id";
        }else{
            $sql = "UPDATE products SET name='$product_name', text='$product_description' WHERE id=$id";
        }

        

        if (mysqli_query($conn,$sql)) {
            header("location:dashboard.php");
        } else {
        echo "حدث خطأ أثناء تحديث البيانات: " . mysqli_error($conn);
        }
    }

?>