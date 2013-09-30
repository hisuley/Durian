<?php
	if(empty($list))
					{$list= array('top'=>'','middle'=>'');}
				foreach ($menutree as $submenu) 
				{
					if($submenu['name'] != $list['top']) {
						echo "<li><span class='collapse'>$submenu[name]</span>"; //第一层li
						echo "<ul style='display: none;'>";						 //第一层ul
						foreach ($submenu['list'] as $submenu2) {
							if (empty($submenu2['list'])) 
								echo "<li class='menuItem'><a href='".$submenu2['href']."'>$submenu2[name]</a></li>";
							else{
								echo "<li><span class='collapse'>$submenu2[name]</span>"; //2层
								echo "<ul style='display: none;'>";						  //2层
								foreach ($submenu2['list'] as $submenu3) {
									echo "<li class='menuItem'><a href='".$submenu3['href']."'>$submenu3[name]</a></li>";
								}
								echo "</ul>";  //2层
								echo "</li>";  //2层
							}
						}
						echo "</ul>"; //第一层ul
						echo "</li>"; //第一层li
					}
					else{
						echo "<li><span class='explode'>$submenu[name]</span>";//1 li
						echo "<ul style='display: block;'>";						//	1 ul
						foreach ($submenu['list'] as $submenu2) {
							if (empty($submenu2['list']))
								echo "<li class='menuItem'><a href='".$submenu2['href']."'>$submenu2[name]</a></li>";
							else{
								if ($submenu2['name'] != $list['middle']) {
									echo "<li><span class='collapse'>$submenu2[name]</span>"; //2层
									echo "<ul style='display: none;'>";						  //2层
									foreach ($submenu2['list'] as $submenu3) {
										echo "<li class='menuItem'><a href='".$submenu3['href']."'>$submenu3[name]</a></li>";
									}
									echo "</ul>";  //2层
									echo "</li>";  //2层
								}
								else {
									echo "<li><span class='explode'>$submenu2[name]</span>"; //2层
									echo "<ul style='display: block;'>";
									foreach ($submenu2['list'] as $submenu3) {
										echo "<li class='menuItem'><a href='".$submenu3['href']."'>$submenu3[name]</a></li>";
									}
									echo "</ul>";  //2层
									echo "</li>";  //2层
								}
							}
						}
						echo "</ul>"; //第一层ul
						echo "</li>"; //第一层li 
					}
				}
