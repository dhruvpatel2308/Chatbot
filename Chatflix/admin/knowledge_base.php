<script>
          var navbarTopShape = window.config.config.phoenixNavbarTopShape;
          var navbarPosition = window.config.config.phoenixNavbarPosition;
          var body = document.querySelector('body');
          var navbarDefault = document.querySelector('#navbarDefault');
          var navbarTop = document.querySelector('#navbarTop');
          var topNavSlim = document.querySelector('#topNavSlim');
          var navbarTopSlim = document.querySelector('#navbarTopSlim');
          var navbarCombo = document.querySelector('#navbarCombo');
          var navbarComboSlim = document.querySelector('#navbarComboSlim');
          var dualNav = document.querySelector('#dualNav');
        
          var documentElement = document.documentElement;
          var navbarVertical = document.querySelector('.navbar-vertical');

          if (navbarPosition === 'dual-nav') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            navbarDefault?.remove();
            navbarVertical?.remove();
            dualNav.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'dual');

          } else if (navbarTopShape === 'slim' && navbarPosition === 'vertical') {
            navbarDefault?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            topNavSlim.style.display = 'block';
            navbarVertical.style.display = 'inline-block';
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');

          } else if (navbarTopShape === 'slim' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            navbarVertical?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTopSlim.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
          } else if (navbarTopShape === 'slim' && navbarPosition === 'combo') {
            navbarDefault?.remove();
            navbarTop?.remove();
            topNavSlim?.remove();
            navbarCombo?.remove();
            navbarTopSlim?.remove();
            dualNav?.remove();
            navbarComboSlim.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navbar-horizontal-shape', 'slim');
          } else if (navbarTopShape === 'default' && navbarPosition === 'horizontal') {
            navbarDefault?.remove();
            topNavSlim?.remove();
            navbarVertical?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarTop.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'horizontal');
          } else if (navbarTopShape === 'default' && navbarPosition === 'combo') {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarDefault?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarCombo.removeAttribute('style');
            navbarVertical.removeAttribute('style');
            document.documentElement.setAttribute('data-navigation-type', 'combo');
          } else {
            topNavSlim?.remove();
            navbarTop?.remove();
            navbarTopSlim?.remove();
            navbarCombo?.remove();
            navbarComboSlim?.remove();
            dualNav?.remove();
            navbarDefault.removeAttribute('style');
            navbarVertical.removeAttribute('style');
          }

          var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
          var navbarTop = document.querySelector('.navbar-top');
          if (navbarTopStyle === 'darker') {
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
          }

          var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
          var navbarVertical = document.querySelector('.navbar-vertical');
          if (navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
          }

          document.addEventListener('DOMContentLoaded', function() {
          // Add event listener for file input change
          var fileInput = document.getElementById('pdfFile');
          if (fileInput) {
            fileInput.addEventListener('change', function() {
              var filePath = fileInput.value;  // Get the full file path
              var fileName = filePath.split('\\').pop().split('/').pop();  // Extract the file name with extension
              var fileNameWithoutExt = fileName.split('.').slice(0, -1).join('.');  // Remove the extension

              // Check if the title field is empty before setting the file name
              var titleField = document.getElementById('kb_title');
              if (titleField && titleField.value.trim() === '') {
                titleField.value = fileNameWithoutExt;  // Set the file name only if the title is empty
              }
            });
          }
        });
        </script>
        <div class="content">
          <nav class="mb-3" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"></li>
              <li class="breadcrumb-item active">Knowledge Base</li>
            </ol>
        </nav>
          <h2 class="text-bold text-body-emphasis mb-5">Knowledge Base</h2>
          <div id="members" data-list='{"valueNames":["customer","email","mobile_number","city","last_active","joined"],"page":10,"pagination":true}'>
            <div class="row align-items-center justify-content-between g-3 mb-4">
              <div class="col col-auto">
                <!--<div class="search-box">
                  <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Search members" aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>
                  </form>
                            </div>-->
                          </div>
              <div class="col-auto">
                <div class="d-flex align-items-center"><button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
                  <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fas fa-plus me-2"></span>Add Knowledge Base</button></div>
                      </div>
              <!-- Full page loader (Make sure this is globally positioned) -->
                <div id="fullPageLoader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; text-align: center;">
                  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                    <div class="spinner-border text-light" role="status" style="width: 3rem; height: 3rem;">
                      <span class="visually-hidden">Loading...</span>
                          </div>
                    <p style="color: white; font-size: 1.5rem;">Processing, please wait...</p>
                        </div>
                      </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Knowledge Base - PDF</h5><button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="UploadForm" action="index.php?knowledge_base" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                            <input class="form-control flex-1" id="text" type="hidden" value="<?php echo $admin_id; ?>" name="admin_id" /> <br>
                            <label>PDF Title</label>
                            <input class="form-control flex-1" id="kb_title" type="text" placeholder="PDF Title" name="kb_title" /> <br>

                            <label>Knowledge Base Type</label>
                            <input class="form-control flex-1" id="text" type="text" placeholder="PDF" value="PDF" name="kb_type" disabled /> <br>

                            <label>Upload PDF</label>
                            <input class="form-control flex-1" id="pdfFile" type="file" name="file"  accept="application/pdf" /> <br>

                            <label>PDF Description</label>
                            <textarea class="form-control" rows="5" cols="10" name="kb_desc"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" id="addKbBtn" type="submit" name="add_kb">ADD</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
              <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                  <thead>
                    <tr>
                      <th class="white-space-nowrap fs-9 align-middle ps-0">
                        <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-members-select" type="checkbox" data-bulk-select='{"body":"members-table-body"}' /></div>
                      </th>
                      <th class="sort align-middle" scope="col" data-sort="customer" style=>ADMIN</th>
                      <th class="sort align-middle" scope="col" data-sort="email" style="width:15%; min-width:200px;">DETAILS</th>
                      <!-- <th class="sort align-middle pe-3" scope="col" data-sort="mobile_number" style="width:20%; min-width:200px;">KB TYPE</th> -->
                      <th class="sort align-middle" scope="col" data-sort="city" style="width:10%;">KNOWLEDGE BASE</th>
                      <!-- <th class="sort align-middle text-end" scope="col" data-sort="last_active" style="width:21%;  min-width:200px;">KNOWLEDGE BASE</th> -->
                      <th class="sort align-middle text-end pe-0" scope="col" data-sort="joined" style="width:19%;  min-width:200px;">UPLOADED AT</th>
                      <th class="sort align-middle text-end pe-0" scope="col" data-sort="joined" style="width:19%;  min-width:200px;">ACTIONS</th>
                    </tr>
                  </thead>
                  <tbody class="list" id="members-table-body">
                    <?php

                    $select = "SELECT * FROM knowledge_base ORDER BY kb_id desc";
                    $run = pg_query($con, $select);
                    while ($row = pg_fetch_array($run)) {
                     
                      $admin_id = $row['admin_id'];
                      $kb_id = $row['kb_id'];
                      $kb_title = $row['kb_title'];
                      $kb_desc = $row['kb_desc'];
                      $kb_type = $row['kb_type'];
                      $kb_status = $row['kb_status'];
                      $kb_file = $row['kb_file'];
                      $kb_created_at = $row['kb_created_at'];

                      $select_admin = "select * from admin_tbl where admin_id='$admin_id'";
                      $run_admin = pg_query($con,$select_admin);
                      $row_admin = pg_fetch_array($run_admin);
                      $admin_id = $row_admin['admin_id'];
                      $admin_name = $row_admin['admin_name'];
                      $admin_pic = $row_admin['admin_pic'];    

                  ?>
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="fs-9 align-middle ps-0 py-3">
                        <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" /></div>
                      </td>
                      <td class="customer align-middle white-space-nowrap">
                        <a class="d-flex align-items-center text-body text-hover-1000" href="#!">
                          <div class="avatar avatar-m"><img class="rounded-circle" src="<?php echo $admin_pic; ?>" alt="" /></div>
                          <h6 class="mb-0 ms-3 fw-semibold"><?php echo $admin_name; ?></h6>
                        </a>
                      </td>
                      <td class="email align-middle white-space-nowrap">
                        <?php echo $kb_title; ?> <br>
                        <?php echo $kb_desc; ?>
                      </td>
                      <td class="mobile_number align-middle white-space-nowrap">
                        <div class="p-4 code-to-copy">
                          <span class="badge badge-phoenix badge-phoenix-info">PDF</span>
                        </div>
                      </td>
                    
                      <td class="joined align-middle white-space-nowrap text-body-tertiary text-end">
                        <?php echo date('d M, Y', strtotime($kb_created_at)); ?> <br>
                        <?php echo date('h:i A', strtotime($kb_created_at)); ?>
                      </td>
                      <td class="joined align-middle white-space-nowrap text-body-tertiary text-end">
                        <!-- <button class="btn btn-outline-success me-1 mb-1" type="button" name="upload_embed">Process</button> -->
                        <!-- <button class="btn btn-outline-info me-1 mb-1" type="button">Update</button> -->
                        <a href="index.php?kb_delete=<?php echo $kb_id; ?>"><button class="btn btn-outline-danger me-1 mb-1" type="button" >Delete</button> </a>                       
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_update">Update</button></div>
                      </td>
                    </tr>

                    <div class="modal fade" id="exampleModal_update" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Knowledge Base - PDF</h5><button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="index.php?knowledge_base" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                            <input class="form-control flex-1" id="text" type="hidden" value="<?php echo $kb_id; ?>" name="kb_id" /> <br>
                            <input class="form-control flex-1" id="text" type="hidden" value="<?php echo $admin_id; ?>" name="admin_id" /> <br>
                            <label>PDF Title</label>
                            <input class="form-control flex-1" id="text" type="text" placeholder="<?php echo $kb_title; ?>" name="kb_title" disabled/> <br>

                            <label>Knowledge Base Type</label>
                            <input class="form-control flex-1" id="text" type="text" placeholder="PDF" value="PDF" name="kb_type" disabled /> <br>

                            <label>Upload PDF</label>
                            <input class="form-control flex-1" id="text" type="file" name="file" accept="application/pdf" /> <br>

                            <label>PDF Description</label>
                            <textarea class="form-control" rows="5" cols="10" name="kb_desc"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="update_kb">Update</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                  <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                  <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                </div>
              </div>
            </div>
          </div>
          <?php include('partials/footer.php'); ?>
        </div>
        <?php include('partials/additional.php'); ?>


<?php

  include('partials/connect.php');
        
  $config_path = realpath(dirname(__FILE__) . '/../config.ini');

  if (!file_exists($config_path)) {
		die("Error: Configuration file not found at $config_path");
	}

  // Parse the configuration file
  $config = parse_ini_file($config_path, true);

  // Extract backend configuration values
  $backendIP = $config['backend']['ip'];
  // Check connection
  if (pg_last_error())
  {
      echo "Failed to connect to MySQL: " . pg_connect_error();
  }

  if(isset($_POST['add_kb']))
  {
      $admin_id = pg_escape_string($con, $_POST['admin_id']);
      $kb_title = pg_escape_string($con, $_POST['kb_title']);
      $kb_type = 'pdf';
      $kb_desc = pg_escape_string($con, $_POST['kb_desc']);
      $image = $_FILES['e']['name'];

      $temp_name  = $_FILES['file']['tmp_name'];  
      $source_image_path = basename($_FILES['file']['name']);
      $ext = pathinfo($source_image_path,PATHINFO_EXTENSION);
      $random_code=md5(uniqid(rand(),true));
      $destination_file_name = pathinfo($source_image_path, PATHINFO_FILENAME) . "." . strtolower($ext);//$source_image_path . "." . strtolower($ext);
      $name = $destination_file_name;
      $folder = "assets/pdf/".$name;
      $upload_image = move_uploaded_file($temp_name, $folder);
      $image_uploaded = "assets/pdf/".$name;
      
      $query = pg_query($con,"SELECT * FROM knowledge_base WHERE kb_title='$kb_title'");

      if(pg_num_rows($query)>0)
      {
          echo "<script>alert('Details already Exits ....')</script>";
          echo "<script>window.open('index.php?knowledge_base','_self')</script>";
      }
      else 
      {
        $sql="INSERT INTO knowledge_base (admin_id, kb_title, kb_file, kb_type, kb_desc, kb_status, kb_created_at)
        VALUES('$admin_id', '$kb_title', '$image_uploaded', '$kb_type', '$kb_desc', '0',  NOW())";

        $result = pg_query($con,$sql);
        if (!$result)
        {
          echo "<script>alert('Error inserting into knowledge base.')</script>";
          die('Error: ' . pg_result_error($con));
        }
        else
        {

          //Retrieve the knowledge_id of the inserted row
          $query_kb_id = pg_query($con, "SELECT kb_id FROM knowledge_base WHERE kb_title = '$kb_title'");
          $row = pg_fetch_assoc($query_kb_id);
          $knowledge_id = $row['kb_id'];
          
          //Reset cache by sending a post request to the python backend
          $resetCacheUrl = "http://$backendIP:8080/reset-cache";
          $data = http_build_query(array('knowledge_id' => $knowledge_id));

          //Using file_get_contents to make a POST request to reset cache
          $options = [
              'http'=> [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $data
              ]

            ];
          
          $context = stream_context_create($options);
          $result = file_get_contents($resetCacheUrl, false, $context);

          if($result == FALSE){
            //Handle error if the reset cache request fails
            echo "<script>alert('Error: Unable to reset cache.');</script>";
          }
          else{
            echo "<script>alert('Knowledge Base updated Successfully (Added) and Cache Reset Successfully');</script>";
			    }



          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://$backendIP:8080/pdf",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
              'file'=> new CURLFILE($image_uploaded),
              'knowledge_id' => $knowledge_id // Pass knowledge_id to the endpoint
            ),  
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          if($response === false) {
            echo "<script>alert('Error uploading PDF to Python backend.');</script>";
          } else {
            echo "<script>alert('Knowledge Base added successfully.');</script>";
          }

          echo "<script>window.open('index.php?knowledge_base','_self')</script>";
        }
    }
  }
  elseif(isset($_POST['update_kb']))
  {
    $kb_id = pg_escape_string($con, $_POST['kb_id']);
    $kb_desc = pg_escape_string($con, $_POST['kb_desc']);

    $file_name = $_FILES['file']['name'];
    $temp_name  = $_FILES['file']['tmp_name'];  
    if($file_name){
      $source_image_path = basename($_FILES['file']['name']);
      $ext = pathinfo($source_image_path,PATHINFO_EXTENSION);
      $random_code=md5(uniqid(rand(),true));
      $destination_file_name = $random_code . "." . strtolower($ext);
      $folder = "assets/pdf/".$destination_file_name;
      // Attempt to move the uploaded file
      if (!move_uploaded_file($temp_name, $folder)) {
        echo "<script>alert('Error: Unable to move the uploaded file. Check folder permissions.');</script>";
        return;
      }
      $image_uploaded = $folder;
    } else{
      echo "<script>alert('No file selected for upload.');</script>";
      return;
    }
    
    $query = pg_query($con,"SELECT kb_title from knowledge_base where kb_id = '$kb_id'");
    $result = pg_fetch_assoc($query);
    $old_title = $result['kb_title'];
    //Update query
    $sql="UPDATE knowledge_base SET kb_file = '$image_uploaded', kb_desc = '$kb_desc' WHERE kb_id = $kb_id ";//kb_file = '$image_uploaded',
    if (!pg_query($con,$sql))
    {
      echo "<script>alert('Error updating knowledge base.');</script>";
      die('Error: ' . pg_result_error($con));
    }
    else
    {
       //Cache reset logic
       $resetCacheUrl = "http://$backendIP:8080/reset-cache";
       $data = http_build_query(array('knowledge_id' => $kb_id));
       $options = [
          'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => $data
          ]
        ]; 
       $context = stream_context_create($options);
       $result = file_get_contents($resetCacheUrl, false, $context);
       
       if ($result == FALSE){
          echo "<script>alert('Error: Unable to reset cache.');</script>";
       } else {
          echo "<script>alert('Knowledge Base updated successfully and cache reset.');</script>";
       }

      $getEmbedID = "select uuid FROM public.langchain_pg_embedding where cmetadata->>'source' LIKE '%" . ($old_title) . "%' OR cmetadata->>'file_path' LIKE '%" . ($old_title) . "%'";
       //Delete previous embeddings if they exist
      //$getEmbedID = "SELECT uuid FROM public.langchain_pg_embedding 
			//		            WHERE cmetadata->>'source' LIKE '%". pg_escape_string($con, $image_uploaded) . "%'
      //                OR cmetadata->>'file_path' LIKE '%". pg_escape_string($con, $image_uploaded) . "%'"; 
      $resEmbed = pg_query($con,$getEmbedID);

      if (!$resEmbed) {
        echo "<script>alert('Error: SQL query failed.');</script>";
        return;
      }

      while ($embedID = pg_fetch_assoc($resEmbed)) {
        $uuid = $embedID['uuid'];
        $delEmbed = "DELETE FROM public.langchain_pg_embedding WHERE uuid='$uuid'";
        if (!pg_query($con, $delEmbed)) {
            echo "<script>alert('Error deleting embedding.');</script>";
        }
      }

      //Upload new file to python endpoint
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://$backendIP:8080/pdf",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
          'file'=> new CURLFILE($image_uploaded),
          'knowledge_id' => $knowledge_id // Pass knowledge_id to the endpoint
        ),  
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      if ($response === false) {
          echo "<script>alert('Error uploading file to Python backend.');</script>";
      } else {
          echo "<script>alert('Knowledge Base updated successfully.');</script>";
      }
      echo "<script>window.open('index.php?knowledge_base','_self')</script>";
    }

  }
  pg_close($con);
  ?>
