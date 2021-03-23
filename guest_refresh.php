<?php
include 'config.php';
include 'include/function.php';
session_start();
$fac = $_GET['q'];
$stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
?>



   <!-- Start-post-->
                                <?php 
                                    //Get user's posts.
                                    $posts = getallarticleperfaculty($fac,$conn);
                                    //Loop through the $posts array IF it is an array.
                                    if(is_array($posts)){
                                    foreach($posts as $view){ 
                                ?> 
                               
                                <div class="card gedf-card" >
                                    <div class="card-header text-white bg-dark">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mr-2">
                                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="h5 m-0"><?php echo $view['studentemail'] ?></div>
                                                    <div class="h7 text-muted"><?php echo "Student Submission ID: ".$view['stusub']."" ; ?></div>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div>
                                               
                                            <br>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php echo $view['datetime'] ?></div>
                                        <a class="card-link" >
                                            <h5 class="card-title"><?php echo $view['articletitle'] ?></h5>
                                        </a>
                                        <!-- Image /////-->
                                        <div class="photo-gallery"> 
                                            <?php 
                                                                       
                                            $view['image'] = trim($view['image'],'\,');
                                            $temp = explode(',',$view['image'] );                         
                                            $s = array_filter($temp); 

                                            foreach($s as $key => $ew){  
                                            ?> 
                                                <a href="image/<?php echo $ew; ?>" data-lightbox="photos" class ="mt-2 mb-5">
                                                <img src="image/<?php echo $ew; ?>" class="img-fluid img-thumbnail" width="200px" height="200px" /> </a>                           
                                                
                                            <?php  ; }  ?> 
                                         </div>
                                        <!-- End Image /////-->
                                        <p class="card-text"><?php echo $view['desc'] ?></p>    
                                        <p class="card-text"><?php getdocument($view['document'] , $conn) ?></p>                                                                       </p>
                                    </div>
                                    <div class="card-footer">                        
                                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>      
                                        <?php
                                        //getting coordinator username
                                         $cor = getCoordinatorName($fac,$conn);   
                                         viewcomment($view['stusub'],$cor , $conn)
                                        ?>                                   
                                    </div>
                                </div>
                                <?php } } //end foreach and if statement?>
                                <!-- End-post -->