<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>
<?php if( !$is_template ) { ?>
<select name="<?php echo $name; ?>" class="vp-input vp-js-fontawesome vp-fontawesome <?php echo $cssclass ?>" autocomplete="off">
<?php }else{ 
preg_match_all("/\[([^\]]*)\]/", $name, $matches);
$target_field = $matches[1][count($matches[1])-1];
?>
<select name="%template%[<?php echo $target_field; ?>]" class="vp-input vp-js-fontawesome vp-fontawesome <?php echo $cssclass ?>" autocomplete="off">
<?php } ?>

	<option></option>
	<?php foreach ($items as $item): ?>
	<option <?php if($item->value == $value) echo "selected" ?> value="<?php echo $item->value; ?>"><?php echo $item->label; ?></option>
	<?php endforeach; ?>
</select>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>