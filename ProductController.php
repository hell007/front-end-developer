<?php



手机处理方式  5次查询


2018 iphone          packId 1   pid 0

		iphone8      packId 2   pid 1

		iphone8plus  packId 3   pid 1

		iphoneX      packId 4   pid 1


goodsSn  100000  packId 2   pkey 0,0


		 2                     3                 4
版本  iphone8(10000)  iphone8plus(10004)   iphoneX(10005)  

颜色   金色(10000)    灰色(10001)    红色(10002)           

容量   128G (10000)   256G (10003)           ||  根据packId==2  查出 goods  (goodsSn  goodsVolume)


1. packId 2   =>  (if pid !=0)   


	根据pid==1 查出   版本  0#iPhone8|1#iPhone8 Plus|2#iPhoneX
	
	packId ==2  自己

	packId ==3 查出一条

	packId ==4 查出一条



list<PackAttr>  attrName  attrValue  packId



2. 根据packId =2  查出  类型  0#移动|1#电信|2#联通
						
						颜色  0#金色|1#灰色|2#银色

						容量  0#128G|1#256G




List<Goods>   packId==2  => 6   goodsSn  goodsColor


3 x 3 x 3 x 2 =  54 个

3. 拆分 类型    [移动 , 电信 , 联通]  p   filter   



goodsSn:

pkey  0,0,0,0 

if(attrType==0)版本  1 网络  2颜色  3容量 ...

p[i]list 

p[i]len 






for(i=0;i<p[j].len;i++){
		if (goodsSn === goods.goodsSn ){
			
			p.put("name":移动)  ? sku==0  '缺货' ：'正常'
			p.put("goodsn":goodsn) === ? 
		
			p.put("isChecked":true)  	
		}
}





4. 拆分 颜色    [金色 , 灰色 , 银色]  p   filter   goodsColor 

 packId==2    goodsVolume==0  =》 条件得到3条数据 

for(){

	if index == pkey  {
		p.add goodsSn  if goodsSn === goods.goodsSn  checked
	}
	
}



5. 拆分 容量    [128G , 256G]  p


packId ==2   goodsColor==0  =》 条件得到2条数据 


for(){

	if index == pkey  {
		p.add goodsSn  if goodsSn === goods.goodsSn  checked
	}
	
}



#############################



packId ==5   属性

   尺寸   0#50|1#55|2#60

	
   List<PackAttr>

   50   55   60   p


   List<Goods>


   for(){

	if index == pkey  {
		p.add goodsSn  if goodsSn === goods.goodsSn  checked
	}
	
}




#######      




packId==null 


name   price

	
	
	
	
namespace Home\Controller;
/**
*ProductController
*/
class ProductController extends CommonController {
	
    public function goods(){
		$gid = isset($_GET['gid']) ? intval($_GET['gid']) : $this->error('抱歉，没有找到你想要的商品!');
        //获取商品基本信息
		$g = M('goods');
		$goods = $g->where('goods_id='.$gid)->find();
		$mapArray= $g->field('category_id,goods_price,brand_id')->where('goods_id='.$gid)->find();
        if (!$goods) {
            $this->error('抱歉，没有找到你想要的商品!');
        }
        if (!$goods['is_on_sale']) {
            $this->error('此商品已经下架！');
        }
		//储存价格//促销未过期，商品的价格是我们的促销价
		if ($goods['is_promote'] && $goods['promote_stime'] <= time() && $goods['promote_etime'] > time()) {
			$price = $goods['promote_price'];
		}else{
			$price = $goods['goods_price'];
		}
		$_SESSION['all_price'] = $price;
		//商品相册
		$gallery = M('gallery');
		$galleryList = $gallery->where('goods_id='.$gid)->select();
		//商品描述
		$ginfo = M('goods_info');
		$gdsinfo = $ginfo->where('goods_id='.$gid)->find();
		//配件搭配
		$c = M('category');
		$peijianMap['category_id'] = array('in','11,12,13,14,15,16,17,18,19,20');
		//配件
		$peijianGds=$g->field('goods_id,category_id,goods_name,goods_price,save_price,small_pic')->where($peijianMap)->select();
		//配件栏目和栏目下共有多少个配件
		$peijianCat=$c->field('category_id,category_name')->where('pid = 4')->select();
		foreach($peijianCat as $k => $v) {
			$category_id=$peijianCat[$k]['category_id'];
			$peijianCat[$k]['category_num'] = $g->where('category_id =' .$category_id)->count();
		}

		//同价位
		$priceMap= array();
		$fifterPrice=$mapArray['goods_price'];
		$maxPrice=$fifterPrice+500;
		$minPrice=$fifterPrice-500;
		$priceMap['category_id']=$mapArray['category_id'];
		$priceMap['goods_price'] = array(between,array($minPrice,$maxPrice));
		$priceMap['goods_id']  = array('neq',$gid);
		$priceMap['_logic'] = 'And';
		$priceEqGds=$g->field('goods_id,goods_name,goods_price,medium_pic')->where($priceMap)->limit('5')->select();
		//同品牌
		$brindMap= array();
		$brindMap['category_id']= $mapArray['category_id'];
		$brindMap['brand_id'] = $mapArray['brand_id'];
		$brindMap['goods_id']  = array('neq',$gid);
		$brindMap['_logic'] = 'And';
		$brandEqGds=$g->field('goods_id,goods_name,goods_price,medium_pic')->where($brindMap)->limit('5')->select();
		//网站关键词，描述信息
		$categoryModel = D('Category');
        $category = $categoryModel->category($mapArray['category_id']);
        $category = $category[0];
		$this->assign('category', $category);
		
		//新品推荐 
		$categoryMap['is_first']=1; 
		$categoryMap['category_id']=$mapArray['category_id'];
		$recommendGds=$g->field('goods_id,goods_name,goods_price,medium_pic')->where($categoryMap)->limit('6')->select();
		
		//创建goodsModel
		$goodsModel = D('Goods');
        //获取商品的规格,读取商品包
		$pack = M("pack")->where("type_id = ".$goods['goods_pack'])->order('orders desc,type_id asc')->find();
		$pack2 = M("pack")->where("parent_id = ".$pack['parent_id'])->select();
		foreach($pack2 as $k => $v){
			$array_pack_id[$k] = $v['type_id'];
		}
		$wpid['goods_pack'] = array('in',implode(',',$array_pack_id));
		$package_goods = M("goods")->field("goods_sn,goods_name,goods_id,goods_pack,goods_color,goods_volume,goods_type,pack_value_list")->where($wpid)->order('goods_color asc,goods_volume asc,goods_type asc')->select();
		$parent_id=$pack['parent_id'];
		$package= M("pack_attr")->where("type_id = ".$goods['goods_pack'])->order('orders desc,attr_id asc')->select();
		







		
		$goods_specs=$this->getGoodsPackList($package,$package_goods,$goods['goods_id'],$goods['pack_value_list'],$goods['goods_color'],$goods['goods_volume'],$goods['goods_type'],$goods['goods_pack'],$parent_id);
		//dump($goods_specs);
		
		
       

	
    }
	
	
	
	

/*************************************************/

	// 获取商品包内容  # 商品包  商品包中的所有商品ID  商品类型编号  商品包值  当前版本ID 版本父级ID
	function getGoodsPackList($pack,$goods,$goods_id,$pvl2,$goods_color,$goods_volume,$goods_type,$pack_id,$parent_id){
		$str = '';
		$pvls = explode(',',$pvl2);
		$pvl[0] = $goods_color;
		$pvl[1] = $goods_volume;
		$pvl[2] = $goods_type;
		foreach($pack as $k => $v){
			if($k == 2 && $goods_type <= 0){
			} else {
				if($v['attr_values']){
					$str .= '<li class="pro_spec"><span>'.$v['attr_name'].'：</span>';
					$attr = explode('|',$v['attr_values']);
					foreach($attr as $ck => $cv){
						$v2 = explode('#',$cv);
						$p = explode('-',$pvl[$k]);
						$ks = 0;
						if($v2[0] > 0){
							if($pvl[$k] == $v2[0]){
								$ks = $goods_id;
								$str .= '<span><a href="/index.php/Product/Goods/gid/'.$goods_id.'.html" class=" current"><em class="value">'.$v2[1].'</em></a></span>';
							} else {
								$str .= $this->getpackinfo($pack_id,$goods,$pvls,$v2[1],$v['attr_id'],$k,$v2[0],$goods_color,$goods_volume,$goods_type);
							}
						}
					}
				}
			}
		}

		$where['parent_id'] = $parent_id;
		$packlist = M("pack")->where($where)->order('orders desc,type_id asc')->select();
		if(count($packlist) > 1){
			$str .= '<li class="pro_spec"><span>版本：</span>';
			foreach($packlist as $pk => $pv){
				if($pack_id == $pv['type_id']){
					$str .= '<span><a href="/index.php/Product/Goods/gid/'.$goods_id.'.html" class=" current"><em class="value">'.$pv['type_name'].'</em></a></span>';
				} else {
					$str .= $this->getpackinfo2($pack_id,$goods,$pvls,$pv['type_id'],$pv['type_name'],$goods_volume);
				}
			}
		}
		return $str;
	}		
	
	function getpackinfo($pack_id,$goods,$pvl,$name,$attr_id,$k,$v,$goods_color,$goods_volume,$goods_type){
		$m = array();
		foreach($pvl as $uk => $uv){
			if($k == $uk){
				$m[$uk] = $attr_id.'-'.$v;
			} else {
				$m[$uk] = $uv;
			}
		}
		$m2 = implode(',',$m);
		$ks = 0;
		foreach($goods as $gk => $gv){
			if($pack_id == $gv['goods_pack']){
				if($k == 0){
					if($gv['goods_color'] == $v && $gv['goods_volume'] == $goods_volume){
						$ks = $gv['goods_id'];break;
					}
				} else if($k == 1){
					if($gv['goods_color'] == $goods_color && $gv['goods_volume'] == $v){
						$ks = $gv['goods_id'];break;
					}
				}
				if($gv['pack_value_list'] == $m2){
					$ks = $gv['goods_id'];break;
					//$ks = $gv['goods_color'].'-'.$gv['goods_volume'];
				}
			}
		}
		if($ks){
			$str .= '<span><a href="/index.php/Product/Goods/gid/'.$ks.'.html" class=""><em>'.$name.'</em ></a></span>';
		} else {
			$str .= '<span><a href="javascript:;" style="border:1px #ccc dashed;color:#999;cursor:not-allowed;"><em>'.$name.'</em></a></span>';
		}
		return $str;
	}
	
	function getpackinfo2($pack_id,$goods,$pvl,$type_id,$name,$goods_volume){
		$m1 = array();
		foreach($pvl as $uk => $uv){
			$p = explode("-",$uv);
			$m1[$uk] = $p[1];
		}
		$ks = false;
		$m1 = implode(',',$m1);
		foreach($goods as $gk => $gv){
			if($type_id == $gv['goods_pack']){
				$m2 = array();
				$pv = explode(',',$gv['pack_value_list']);
				foreach($pv as $uk => $uv){
					$p = explode("-",$uv);
					$m2[$uk] = $p[1];
				}
				$m2 = implode(',',$m2);
				if(strpos($m2,$m1) > -1 || strpos($m1,$m2) > -1){
					$ks = $gv['goods_id'];
					
				}
			}
		}
		if($ks){
			$str .= '<span><a href="/index.php/Product/Goods/gid/'.$ks.'.html" class=""><em>'.$name.'</em></a></span>';
		} else {
			$wg['goods_volume'] = $goods_volume;
			$wg['goods_pack'] = $type_id;
			$r = M("goods")->field("goods_id")->where($wg)->order('goods_color asc,goods_volume asc,goods_type asc')->find();
			if($r && $r !== false){
				$str .= '<span><a href="/index.php/Product/Goods/gid/'.$r['goods_id'].'.html" class=""><em>'.$name.'</em></a></span>';
			} else {
				$r = M("goods")->field("goods_id")->where("goods_pack = ".$type_id)->order('goods_color asc,goods_volume asc,goods_type asc')->find();
				if($r && $r !== false){
					$str .= '<span><a href="/index.php/Product/Goods/gid/'.$r['goods_id'].'.html" class=""><em>'.$name.'</em></a></span>';
				}
			}
		}
		return $str;
	}
	//end
	
	

}
