<?php
/**
 * @file
 * Template to render ting_releation content.
 */
?>

<?php 
if( empty($content) ) {
  return;
}

foreach( $content as $ns => $relations ){
  if (!empty($relations)) { ?>
<a name="<?php echo $ns;?>"></a>
<div class="<?php print $classes.' ting-relation-'.drupal_html_class($ns).' clearfix'; ?>"> 
  <h2><?php echo isset($relations[0]['type']) ? $relations[0]['type'] : ""; ?></h2>

<?php foreach( $relations as $key=>$relation ) { ?>

<div class="meta">
<?php 
if( isset($relation['title']) ) {
print '<h3>'.$relation['title'].'</h3>';
}
if( isset($relation['year']) ) {
print '<div>'.$relation['year'].'</div>';
}
if( isset($relation['creator']) ) {
print '<div>'.$relation['creator'].'</div>';
}
if( isset($relation['byline']) ) {
print '<div>'.$relation['byline'].'</div>';
}
if( isset($relation['isPartOf']) ) {
print $relation['isPartOf'];
}
?>
</div>

<?php
if( isset($relation['abstract']) ) {
print '<div>'.$relation['abstract'].'</div>';
}

if( isset($relation['text']) ) {
print '<div>'.$relation['text'].'</div>';
}

if( isset($relation['online_url']) ) {
print '<div class="field-type-ting-relation">';
print '<div class="field-items rounded-corners">';
//Convert infomedia urls to working urls. there is maby another place
//that this could be done. but cant find it ?
$OnlineLink = isset($relation['online_url']) ? $relation['online_url'] : null;
if(isset(urldecode($OnlineLink['#markup'])) && strpos(urldecode($OnlineLink['#markup']),'[useraccessinfomedia]') !== false
 && strpos(urldecode ($OnlineLink['#markup']),'action=getArticle') !== false) 
{
    $splitresult = explode('faust=', urldecode($OnlineLink['#markup']));
    $splitresult = explode('&',  $splitresult[1]);
    $relation['online_url'] = "<a target='_blank' href='/ting/infomedia/" . $splitresult[0] . "'>Læs</a>";
}
print render($relation['online_url']);
print '</div></div>';
}

if( isset($relation['docbook_link']) ) {
print render($relation['docbook_link']); 
}

print '<div class="clearfix"></div>';
 }
} // end foreach relation
?>
</div>
<?php } // end foreach content
?>







