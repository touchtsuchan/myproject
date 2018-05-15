
<?php 
require_once 'config.php';
$username = $password = "";
$username_err = $password_err = "";


function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {

  if (!is_array($user_tree_array))
    $user_tree_array = array();

  $sql = "SELECT `cid`, `name`, `parent` FROM `category` WHERE 1 AND `parent` = $parent ORDER BY cid ASC";
  $query = mysql_query($sql);
  if (mysql_num_rows($query) > 0) {
    while ($row = mysql_fetch_object($query)) {
      $user_tree_array[] = array("id" => $row->cid, "name" => $spacing . $row->name);
      $user_tree_array = fetchCategoryTree($row->cid, $spacing . '&nbsp;&nbsp;', $user_tree_array);
    }
  }
  return $user_tree_array;
}

?>


<?php 
$categoryList = fetchCategoryTree();
?>
<select>
<?php foreach($categoryList as $cl) { ?>
  <option value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>
<?php } ?>
</select>

<?php
function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {

    if (!is_array($user_tree_array))
    $user_tree_array = array();

  $sql = "SELECT `cid`, `name`, `parent` FROM `category` WHERE 1 AND `parent` = $parent ORDER BY cid ASC";
  $query = mysql_query($sql);
  if (mysql_num_rows($query) > 0) {
     $user_tree_array[] = "<ul>";
    while ($row = mysql_fetch_object($query)) {
    $user_tree_array[] = "<li>". $row->name."</li>";
      $user_tree_array = fetchCategoryTreeList($row->cid, $user_tree_array);
    }
  $user_tree_array[] = "</ul>";
  }
  return $user_tree_array;
}

?>

<ul>
<?php
  $res = fetchCategoryTreeList();
  foreach ($res as $r) {
    echo  $r;
  }
?>
</ul>