<?php
if($reccnt2 > $pagesize2){
$num_pages=$reccnt2/$pagesize2;
$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];
$m=$_REQUEST;
unset($m['start2']);
$qry_str=qry_str($m);
$j=$start2/$pagesize2-5;
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
				if($i==$j){?><span class=textnopadding><b>PAGE:&nbsp; </b></span><?php }
			   if(($pagesize2*($i))!=$start2)
				  {
	  ?><a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start2=<?php echo $pagesize2*($i);?>" class="black_txt"><strong><?php echo $i+1;?></strong></a>&nbsp;<?php }
	  else{
	  ?><span class="black_txt"><?php echo $i+1;?>&nbsp;</span><?php
	  }?>
<?php }?> 
<a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start2=<?php echo $start2+$pagesize2;?>" class="black_txt">Next</a> 
</span>

<?php }?>