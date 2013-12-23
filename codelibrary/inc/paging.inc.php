<?php
if($reccnt > $pagesize){
$num_pages=$reccnt/$pagesize;
$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];
$m=$_REQUEST;
unset($m['start']);
$qry_str=qry_str($m);
$j=$start/$pagesize-5;
if($j<0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);?>
<span class="black_txt">
      <?php for($i=$j;$i<$k;$i++)
			{
				if($i==$j){?><span class=textnopadding><b>Sayfa:&nbsp; </b></span><?php }
			   if(($pagesize*($i))!=$start)
				  {
	  ?><a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $pagesize*($i);?>" class="black_txt"><strong><?php echo $i+1;?></strong></a>&nbsp;<?php }
	  else{
	  ?><span class="black_txt"><?php echo $i+1;?>&nbsp;</span><?php
	  }?>
<?php }?> 
<a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $start+$pagesize;?>" class="black_txt">Sonraki</a> 
</span>

<?php }?>