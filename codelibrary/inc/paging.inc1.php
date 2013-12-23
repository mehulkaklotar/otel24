<?php
if($reccnt1 > $pagesize1){
$num_pages=$reccnt1/$pagesize1;
$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];
$m=$_REQUEST;
unset($m['start1']);
$qry_str=qry_str($m);
$j=$start1/$pagesize1-5;
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
			   if(($pagesize1*($i))!=$start1)
				  {
	  ?><a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start1=<?php echo $pagesize1*($i);?>" class="black_txt"><strong><?php echo $i+1;?></strong></a>&nbsp;<?php }
	  else{
	  ?><span class="black_txt"><?php echo $i+1;?>&nbsp;</span><?php
	  }?>
<?php }?> 
<a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start1=<?php echo $start1+$pagesize1;?>" class="black_txt">Next</a> 
</span>

<?php }?>