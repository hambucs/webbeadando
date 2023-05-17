<?php

$configFile = 'configuration.json';
$configData = file_get_contents($configFile);
$config = json_decode($configData, true);

$menuItems = $config['menuItems'];

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = $menuItems[0]['name']; 
}

$selectedItem = null;
foreach ($menuItems as $menuItem) {
    if ($menuItem['name'] === $page) {
        $selectedItem = $menuItem;
        break;
    }
}

if ($selectedItem !== null) {
    $url = $selectedItem['url'];
    header("Location: $url");
    exit;
} else {
    header("Location: " . $menuItems[0]['url']);
    exit;
}

?>