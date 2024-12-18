<?php
  declare(strict_types=1);

  // если поле file_name пустое:
  if (empty($_POST['file_name'])) {
    header('Location: ./index.html');  
    exit;
  }

  // если файл не был передан на сервер:
  if (!isset($_FILES['content']) || $_FILES['content']['error'] !== UPLOAD_ERR_OK) {
    header('Location: ./index.html'); 
    exit;
  } 

  // сохраняем файл на сервер в каталог upload:
  $uploadDir = './upload/';

  // Получаем расширение загружаемого файла
  $fileExtension = pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
  $uploadFile = $uploadDir . basename($_POST['file_name'] . '.' . $fileExtension);

  if (move_uploaded_file($_FILES['content']['tmp_name'], $uploadFile)) {
    echo 'Файл был успешно загружен.<br>';
    echo 'Полный путь к файлу: ' . realpath($uploadFile) . '<br>';
    echo 'Размер файла: ' . filesize($uploadFile) . ' байт' . '<br>';
  } else {
    echo 'Ошибка при загрузке файла!<br>';
  }