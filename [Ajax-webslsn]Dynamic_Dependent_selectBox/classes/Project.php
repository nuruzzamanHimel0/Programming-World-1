<?php


class Project
{



	public function addedRowIntoBody($count)
	{
		$html = '';
        $html .= '<tr>';
        $html .= '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
        $html .= '<td><select name="item_category[]" class="form-control item_category" data-sub_category_id="'+$count+'"><option value="">Select Category</option><?php echo fill_select_box($connect, "0"); ?></select></td>';
        $html .= '<td><select name="item_sub_category[]" class="form-control item_sub_category" id="item_sub_category'+$count+'"><option value="">Select Sub Category</option></select></td>';
        $html .= '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-minus"></span></button></td>';
	}


	
}


?>