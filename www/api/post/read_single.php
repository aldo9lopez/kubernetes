<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Post($db);

  // Get ID
  $post->clave = isset($_GET['clave']) ? $_GET['clave'] : die();

  // Get post
  $post->read_single();

  // Create array
  $post_arr = array(
    'clave' => $post->clave,
    'nombre' => $post->nombre,
    'semestre' => $post->semestre,
    'pc' => $post->pc,
    'creditos' => $post->creditos
  );

  // Make JSON
  print_r(json_encode($post_arr));