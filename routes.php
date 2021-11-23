<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header("Content-type:application/json",true);
// header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

$app->group('/api', function () use ($app) {
    
    // Retrieve game all record use fetchAll()     
      
   $app->get('/condo', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM condo ORDER BY condo_id");
    $sth->execute();
    $data = $sth->fetchAll();
    $condo = array("condo"=>$data);
    return $this->response->withJson($condo);
});   


// Retrieve todo with id (get 1 record) use fetchObject()

$app->get('/condo/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM condo WHERE condo_id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $data = $sth->fetchObject();
    $condo = array("condo"=>array($data));
    return $this->response->withJson($condo);
});

// Search for todo with given search term in their name


$app->get('/condo/search/[{query}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("SELECT * FROM condo WHERE UPPER(condo_name) LIKE :query ORDER BY condo_id");
    $query = "%".$args['query']."%";
    $sth->bindParam("query", $query);
    $sth->execute();
    $data = $sth->fetchAll();
    $condo = array("condo"=>$data);
    return $this->response->withJson($condo);
});


$app->post('/condo', function ($request, $response) {
    $input = $request->getParsedBody();
    $newfileName = "";        
    if($input['condo_img'] != 'no_image'){
        try{
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $ext = pathinfo($target_file,PATHINFO_EXTENSION);
            $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
            $newfileNameAndPath = $target_dir . $newfileName;
            $uploadOk = 1;
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                    //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                    $uploadOk = 1;               
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $newfileName = "";
                    
                }
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
                $newfileName = "";
            }
        }catch(Exception $ex){
            return $this->response->withJson($ex);
        }
    }        
    //--- insert data to db
    $sql = "INSERT INTO condo (condo_id,condo_name,condo_price,condo_detail,condo_img,condo_comment) VALUES (:condo_id,:condo_name,:condo_price,:condo_detail,:condo_img,:condo_comment)";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("condo_id", $input['condo_id']);
    $sth->bindParam("condo_price", $input['condo_price']);
    $sth->bindParam("condo_price", $input['condo_price']);
    $sth->bindParam("condo_detail", $input['condo_detail']);
    //$sth->bindParam("game_img", $input['game_img']);
    $sth->bindParam("condo_img", $newfileName);
    $sth->bindParam("condo_comment", $input['condo_comment']);  

    try{
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    }catch(PDOException $e){
        //echo($e);
        return $this->response->withJson(0);
    }
});

$app->post('/condo/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $newfileName = "";        
    if($input['condo_img'] != 'no_image'){
        try{
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $ext = pathinfo($target_file,PATHINFO_EXTENSION);
            $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
            $newfileNameAndPath = $target_dir . $newfileName;
            $uploadOk = 1;
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                    //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                    $uploadOk = 1;               
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                    $newfileName = ""; 
                }
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
                $newfileName = "";
            }
        }catch(Exception $ex){
            return $this->response->withJson($ex);
        }
    }

    if($newfileName != ""){
        $sql = "UPDATE condo SET condo_name=:condo_name, condo_price=:condo_price, condo_detail=:condo_detail, condo_img=:condo_img, condo_comment=:condo_comment WHERE id=:id";
    }else{
        $sql = "UPDATE condo SET condo_name=:condo_name, condo_price=:condo_price, condo_detail=:condo_detail, condo_comment=:condo_comment WHERE id=:id";
    }
    
    $sth = $this->db->prepare($sql);
    $sth->bindParam("id", $args['id']);
    $sth->bindParam("condo_name", $input['condo_name']);
    $sth->bindParam("condo_price", $input['condo_price']);
    $sth->bindParam("condo_detail", $input['condo_detail']);
    $sth->bindParam("condo_comment", $input['condo_comment']); 
    if($newfileName != ""){
        $sth->bindParam("condo_img", $newfileName);
    }

    try{
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    }catch(PDOException $e){
        return $this->response->withJson(0);
    }
});

// DELETE a game with given id

$app->delete('/condo/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM game WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $count = $sth->rowCount();
    return $this->response->withJson($count);
});


    $app->get('/apartment', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM apartment ORDER BY apartment_id");
        $sth->execute();
        $data = $sth->fetchAll();
        $apartment = array("apartment"=>$data);
        return $this->response->withJson($apartment);
   });   


    // Retrieve todo with id (get 1 record) use fetchObject()
    
    $app->get('/apartment/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM apartment WHERE apartment_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $data = $sth->fetchObject();
        $apartment = array("apartment"=>array($data));
        return $this->response->withJson($apartment);
    });

    // Search for todo with given search term in their name
   
    
    $app->get('/apartment/search/[{query}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM apartment WHERE UPPER(apartment_name) LIKE :query ORDER BY apartment_id");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $data = $sth->fetchAll();
        $apartment = array("apartment"=>$data);
        return $this->response->withJson($apartment);
    });

 
    $app->post('/apartment', function ($request, $response) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['apartment_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = "";
                        
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }        
        //--- insert data to db
        $sql = "INSERT INTO apartment (apartment_id,apartment_name,apartment_price,apartment_detail,apartment_img,apartment_comment) VALUES (:apartment_id,:apartment_name,:apartment_price,:apartment_detail,:apartment_img,:apartment_comment)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("apartment_id", $input['apartment_id']);
        $sth->bindParam("apartment_price", $input['apartment_price']);
        $sth->bindParam("apartment_price", $input['apartment_price']);
        $sth->bindParam("apartment_detail", $input['apartment_detail']);
        //$sth->bindParam("game_img", $input['game_img']);
        $sth->bindParam("apartment_img", $newfileName);
        $sth->bindParam("apartment_comment", $input['apartment_comment']);  

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            //echo($e);
            return $this->response->withJson(0);
        }
    });

    // DELETE a game with given id
  
    $app->delete('/apartment/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("DELETE FROM apartment WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    });

    $app->post('/apartment/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['apartment_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = ""; 
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }

        if($newfileName != ""){
            $sql = "UPDATE apartment SET apartment_name=:apartment_name, apartment_price=:apartment_price, apartment_detail=:apartment_detail,apartment_img=:apartment_img, apartment_comment=:apartment_comment WHERE id=:id";
        }else{
            $sql = "UPDATE apartment SET apartment_name=:apartment_name, apartment_price=:apartment_price, apartment_detail=:apartment_detail, apartment_comment=:apartment_comment WHERE id=:id";
        }
        
        $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("apartment_name", $input['apartment_name']);
        $sth->bindParam("apartment_price", $input['apartment_price']);
        $sth->bindParam("apartment_detail", $input['apartment_detail']);
        $sth->bindParam("apartment_comment", $input['apartment_comment']); 
        if($newfileName != ""){
            $sth->bindParam("apartment_img", $newfileName);
        }

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            return $this->response->withJson(0);
        }
    });

    $app->get('/mantion', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM mantion ORDER BY mantion_id");
        $sth->execute();
        $data = $sth->fetchAll();
        $mantion = array("mantion"=>$data);
        return $this->response->withJson($mantion);
   });   


    // Retrieve todo with id (get 1 record) use fetchObject()
    
    $app->get('/mantion/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM mantion WHERE mantion_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $data = $sth->fetchObject();
        $mantion = array("mantion"=>array($data));
        return $this->response->withJson($mantion);
    });

    // Search for todo with given search term in their name
   
    
    $app->get('/mantion/search/[{query}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM mantion WHERE UPPER(mantion_name) LIKE :query ORDER BY mantion_id");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $data = $sth->fetchAll();
        $mantion = array("mantion"=>$data);
        return $this->response->withJson($mantion);
    });

 
    $app->post('/mantion', function ($request, $response) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['mantion_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = "";
                        
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }        
        //--- insert data to db
        $sql = "INSERT INTO mantion (mantion_id,mantion_name,mantion_price,mantion_detail,mantion_img,mantion_comment) VALUES (:mantion_id,:mantion_name,:mantion_price,:mantion_detail,:mantion_img,:mantion_comment)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("mantion_id", $input['mantion_id']);
        $sth->bindParam("mantion_price", $input['mantion_price']);
        $sth->bindParam("mantion_price", $input['mantion_price']);
        $sth->bindParam("mantion_detail", $input['mantion_detail']);
        //$sth->bindParam("mantion_img", $input['mantion_img']);
        $sth->bindParam("mantion_img", $newfileName);
        $sth->bindParam("mantion_comment", $input['mantion_comment']);  

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            //echo($e);
            return $this->response->withJson(0);
        }
    });

    // DELETE a game with given id
  
    $app->delete('/mantion/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("DELETE FROM mantion WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    });

    $app->post('/mantion/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['mantion_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = ""; 
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }

        if($newfileName != ""){
            $sql = "UPDATE mantion SET mantion_name=:mantion_name, mantion_price=:mantion_price, mantion_detail=:mantion_detail,mantion_img=:mantion_img, mantion_comment=:mantion_comment WHERE id=:id";
        }else{
            $sql = "UPDATE mantion SET mantion_name=:mantion_name, mantion_price=:mantion_price, mantion_detail=:mantion_detail, mantion_comment=:mantion_comment WHERE id=:id";
        }
        
        $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("mantion_name", $input['mantion_name']);
        $sth->bindParam("mantion_price", $input['mantion_price']);
        $sth->bindParam("mantion_detail", $input['mantion_detail']);
        $sth->bindParam("mantion_comment", $input['mantion_comment']); 
        if($newfileName != ""){
            $sth->bindParam("mantion_img", $newfileName);
        }

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            return $this->response->withJson(0);
        }
    });


    $app->get('/dormitory', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM dormitory ORDER BY dormitory_id");
        $sth->execute();
        $data = $sth->fetchAll();
        $dormitory = array("dormitory"=>$data);
        return $this->response->withJson($dormitory);
   });   


    // Retrieve todo with id (get 1 record) use fetchObject()
    
    $app->get('/dormitory/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM dormitory WHERE dormitory_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $data = $sth->fetchObject();
        $dormitory = array("dormitory"=>array($data));
        return $this->response->withJson($dormitory);
    });

    // Search for todo with given search term in their name
   
    
    $app->get('/dormitory/search/[{query}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM dormitory WHERE UPPER(dormitory_name) LIKE :query ORDER BY dormitory_id");
        $query = "%".$args['query']."%";
        $sth->bindParam("query", $query);
        $sth->execute();
        $data = $sth->fetchAll();
        $dormitory = array("dormitory"=>$data);
        return $this->response->withJson($dormitory);
    });

 
    $app->post('/dormitory', function ($request, $response) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['dormitory_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = "";
                        
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }        
        //--- insert data to db
        $sql = "INSERT INTO dormitory (dormitory_id,dormitory_name,dormitory_price,dormitory_detail,dormitory_img,dormitory_comment) VALUES (:dormitory_id,:dormitory_name,:dormitory_price,:dormitory_detail,:dormitory_img,:dormitory_comment)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("dormitory_id", $input['dormitory_id']);
        $sth->bindParam("dormitory_price", $input['dormitory_price']);
        $sth->bindParam("dormitory_price", $input['dormitory_price']);
        $sth->bindParam("dormitory_detail", $input['dormitory_detail']);
        //$sth->bindParam("dormitory_img", $input['dormitory_img']);
        $sth->bindParam("dormitory_img", $newfileName);
        $sth->bindParam("dormitory_comment", $input['dormitory_comment']);  

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            //echo($e);
            return $this->response->withJson(0);
        }
    });

    // DELETE a game with given id
  
    $app->delete('/dormitory/[{id}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("DELETE FROM dormitory WHERE id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $count = $sth->rowCount();
        return $this->response->withJson($count);
    });

    $app->post('/dormitory/[{id}]', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $newfileName = "";        
        if($input['dormitory_img'] != 'no_image'){
            try{
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $ext = pathinfo($target_file,PATHINFO_EXTENSION);
                $newfileName = "pict_" . date("Ymd_His") . "_".substr(sha1(rand()), 0, 10) . "." .$ext;
                $newfileNameAndPath = $target_dir . $newfileName;
                $uploadOk = 1;
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newfileNameAndPath)) {
                        //echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
                        $uploadOk = 1;               
                    } else {
                        //echo "Sorry, there was an error uploading your file.";
                        $newfileName = ""; 
                    }
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                    $newfileName = "";
                }
            }catch(Exception $ex){
                return $this->response->withJson($ex);
            }
        }

        if($newfileName != ""){
            $sql = "UPDATE dormitory SET dormitory_name=:dormitory_name, dormitory_price=:dormitory_price, dormitory_detail=:dormitory_detail,dormitory_img=:dormitory_img, dormitory_comment=:dormitory_comment WHERE id=:id";
        }else{
            $sql = "UPDATE dormitory SET dormitory_name=:dormitory_name, dormitory_price=:dormitory_price, dormitory_detail=:dormitory_detail, dormitory_comment=:dormitory_comment WHERE id=:id";
        }
        
        $sth = $this->db->prepare($sql);
        $sth->bindParam("id", $args['id']);
        $sth->bindParam("dormitory_name", $input['dormitory_name']);
        $sth->bindParam("dormitory_price", $input['dormitory_price']);
        $sth->bindParam("dormitory_detail", $input['dormitory_detail']);
        $sth->bindParam("dormitory_comment", $input['dormitory_comment']); 
        if($newfileName != ""){
            $sth->bindParam("dormitory_img", $newfileName);
        }

        try{
            $sth->execute();
            $count = $sth->rowCount();
            return $this->response->withJson($count);
        }catch(PDOException $e){
            return $this->response->withJson(0);
        }
    });




    


    

    $app->post('/user', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "SELECT * FROM login WHERE username=:username AND password=:password";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("username", $input['username']);
        $sth->bindParam("password", $input['password']);
        $sth->execute();
        $count = $sth->rowCount();
        if($count==0){
            $message = (object)array('username' => 'failed', 'password' => 'failed'); 
            return $this->response->withJson($message);
        }else{
            $user = $sth->fetchObject();
            return $this->response->withJson($user);
        }
    });
});