<?php
use App\Models\Category;
function uploadImage($file, $upload_dir,$thumb_size= null){
    $path = public_path().'/uploads/'.$upload_dir;

    if(!File::exists($path)){
        File::makeDirectory($path,0777, true, true);
    }

    $file_name = ucfirst($upload_dir)."-".date('Y-m-d-').rand(0,999).".".$file->getClientOriginalExtension();
    if ($thumb_size != null){
        list($width,$height) =explode('x',$thumb_size);
//        $path = public_path().'/uploads/'.$upload_dir.'/thumb';
        if(!File::exists($path)){
            File::makeDirectory($path,0777, true, true);
        }
        Image::make($file)->resize($width,$height,function ($constraints){
            $constraints->aspectRatio();
        })->save($path.'/Thumb-'.$file_name);

    }
    $success = $file->move($path, $file_name);
    if ($success){
        return $file_name;
    }else{
        return null;
    }

}

 function deleteFile($file_name,$dir){
    if($file_name != null && file_exists(public_path().'/uploads/'.$dir.'/'.$file_name)){
        unlink(public_path().'/uploads/'.$dir.'/'.$file_name);
    }


}
function get_category_menu()
{
    $category = new category();
    $category = $category->getAllCategoryformenu();
    if ($category) {

        foreach ($category as $cat_info) {
            if ($cat_info->child_cats->count() > 0) {
                ?>
                <li>
                    <a href="<?php echo route('category-detail',$cat_info->slug);?>"><?php echo $cat_info->title;?></a>
                    <ul class="dropdown-subcontent">
                        <?php
                        foreach ($cat_info->child_cats as $child_category ){

                          ?>
                            <li><a href="<?php echo route('sub-category-detail',[$cat_info->slug,$child_category->slug]);?>"><?php echo $child_category->title;?></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </li>

                <?php
            } else {
                ?>
                <li>
                    <a href="<?php echo route('category-detail',$cat_info->slug);?>"> <?php echo $cat_info->title;?></a>
                </li>

                <?php

            }
        }
    }
}







