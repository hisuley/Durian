<style type="text/css">
div#home{
width: 1100px;
margin: 0 auto;
}
div#home-head{
padding-bottom: 30px;
border-bottom: 1px solid black;
}
div#home-head-img{
width: 780px;
height: 400px;
}
div#home-head-nav li{
width: 280px;
height: 65px;
}
div#home-activity{
margin: 10px auto;
}
div#home-activity-list-content,div#home-activity-list-content li,div#home-activity-found,div#home-head-nav li,div#home-head-img,div#home-activity-found,div#home-route-promote{
border: 1px solid black;
}
div#home-activity-list>ul li,div#home-route-list>ul li{
width: 100px;
padding: 5px;
}
div#home-activity-list-content,div#home-route-list{
width: 750px;
}
div#home-activity-list-content li{
width: 210px;
height:165px;
margin: 10px 18px;
}
div#home-activity-found,div#home-route-promote{
width: 278px;
height: 400px;
}
div#home-route-list-content li{
height:120px;
}
}
</style>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/css/craftyslide.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/js/craftyslide.js"></script>
<div id="home">
  <div id="home-head">
    <div class="left" id="home-head-img">
      <div id="slideshow">
        <ul>
          <li><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/images/1.jpg" alt=""></li>
          <li><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/images/1.jpg" alt=""></li>
          <li><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/images/1.jpg" alt=""></li>
          <li><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/images/1.jpg" alt=""></li>
          <li><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/slide/images/1.jpg" alt=""></li>
        </ul>
      </div>
    </div>
    <script>
        $("#slideshow").craftyslide({
          'pagination' : false,
          'width' :500,
          'height' : 350,
        });
    </script>
    <div class="right" id="home-head-nav">
      <ul>
        <li>活动</li>
        <li>签证</li>
        <li>酒店</li>
        <li>保险</li>
        <li>租车</li>
        <li>机票</li>
      </ul>
    </div>
    
    <div class="clear"></div>
  </div>
  <div id="home-activity">
    <div class="left" id="home-activity-list">
      <ul>
        <li class="left">特惠活动</li>
        <li class="left">热销活动</li>
      </ul>
      <div class='clear'></div>
      <div id="home-activity-list-content">
        <ul>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
          <li class="left"><img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt=""></li>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="right" id="home-activity-found">
      <h3>发现</h3>
    </div>
    <div class="clear"></div>
  </div>
  <div id="home-route">
    <div id="home-route-list" class='left'>
      <ul>
        <li class="left">特色行程</li>
        <li class="left">特色行程</li>
      </ul>
      <div class="clear"></div>
      <div id="home-route-list-content">
        <ul>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
          <li>
            <div class='left'>
              <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
            </div>
            <div class='left'>
              <h3>ag</h3>
              <p>aggggg</p>
            </div>
          </li>
        </ul>
      </div>
      <div id='imgmap'>
        <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/map.png" alt="" usemap="#Map">
          <map name="Map" id="Map">
            <area shape="circle" coords="100,135,8" href="#" />
            <area shape="circle" coords="189,370,9" href="#" />
            <area shape="circle" coords="368,59,8" href="#" />
            <area shape="circle" coords="346,88,8" href="#" />
            <area shape="circle" coords="670,333,10" href="#" />
            <area shape="circle" coords="625,142,10" href="#" />
            <area shape="circle" coords="606,111,9" href="#" />
            <area shape="circle" coords="536,110,8" href="#" />
            <area shape="circle" coords="539,143,8" href="#" />
            <area shape="circle" coords="554,135,9" href="#" />
            <area shape="circle" coords="539,206,11" href="#" />
            <area shape="circle" coords="383,322,12" href="#" />
            <area shape="circle" coords="430,258,11" href="#" />
            <area shape="circle" coords="337,206,10" href="#" />
            <area shape="circle" coords="318,144,11" href="#" />
            <area shape="circle" coords="317,129,12" href="#" />
            <area shape="circle" coords="317,108,11" href="#" />
            <area shape="circle" coords="341,108,11" href="#" />
            <area shape="circle" coords="383,83,9" href="#" />
            <area shape="circle" coords="370,103,8" href="#" />
            <area shape="circle" coords="395,117,8" href="#" />
            <area shape="circle" coords="408,142,10" href="#" />
            <area shape="circle" coords="423,162,11" href="#" />
            <area shape="circle" coords="588,212,8" href="#" />
            <area shape="circle" coords="593,121,5" href="#" />
            <area shape="circle" coords="580,139,8" href="#" />
            <area shape="circle" coords="603,143,6" href="#" />
            <area shape="circle" coords="580,155,5" href="#" />
            <area shape="circle" coords="606,159,7" href="#" />
            <area shape="circle" coords="595,166,7" href="#" />
            <area shape="circle" coords="595,186,8" href="#" />
            <area shape="circle" coords="400,274,7" href="#" />
            <area shape="circle" coords="405,300,8" href="#" />
          </map>
      </div>
    </div>  
    <div id="home-route-promote" class="right">
      <h3>推荐产品</h3>
      <img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" alt="">
    </div>
  </div>
</div>
<div class="clear"></div>