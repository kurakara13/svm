<div class="ms-paper-menu-left">
  <h3 class="ms-paper-menu-title">
    <i class="zmdi zmdi-apps"></i> Menu
    <a role="button" data-toggle="collapse" href="#collapseMenu" aria-expanded="false" aria-controls="collapseMenu" class="withripple">
      <i class="zmdi zmdi-menu"></i>
    </a>
  </h3>
  <div class="panel-menu collapse" id="collapseMenu">
    <ul class="panel-group ms-collapse-nav" id="components-nav" role="tablist" aria-multiselectable="true">
      <li id="e1">
        <a  class="withripple <?php echo $menu1[0] ?>" href="<?php echo $lvl ?>">
          <i class="fa fa-bold"></i> Testing
        </a>
      </li>
      <hr>
      <li id="e100">
        <a  class="withripple  <?php echo $menu1[1] ?>" href="<?php echo $lvl ?>data">
          <i class="fa fa-bold"></i> Data
        </a>
      </li>
      <li class="card" role="tab" id="e2">
        <a role="button" data-toggle="collapse" data-parent="#components-nav" href="#c2" aria-expanded="true" aria-controls="c2" class="<?php echo $menu1[2] ?> withripple">
          <i class="fa fa-hand-o-up"></i> Preprocessing</a>
        <ul id="c2" class="panel-collapse collapse <?php echo $menuShow[0] ?>" role="tabpanel" aria-labelledby="e2">
          <li>
            <a class="withripple <?php echo $menu2[0] ?>" href="<?php echo $lvl ?>preprocessing/filtering">
              <i class="fa fa-arrow-circle-right"></i> Filtering</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu2[1] ?>" href="<?php echo $lvl ?>preprocessing/splitting">
              <i class="fa fa-arrow-circle-right"></i> Splitting</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu2[2] ?>" href="<?php echo $lvl ?>preprocessing/tokenizing">
              <i class="fa fa-arrow-circle-right"></i> Tokenizing</a>
          </li>
        </ul>
      </li>
      <li class="card" role="tab" id="e3">
        <a role="button" data-toggle="collapse" data-parent="#components-nav" href="#c3" aria-expanded="true" aria-controls="c3" class="<?php echo $menu1[3] ?> withripple">
          <i class="fa fa-briefcase"></i> Ekstraksi Fitur</a>
        <ul id="c3" class="panel-collapse collapse <?php echo $menuShow[1] ?>" role="tabpanel" aria-labelledby="e3">
          <li>
            <a class="withripple <?php echo $menu3[0] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/initcaps">
              <i class="fa fa-arrow-circle-right"></i> INITCAPS </a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[1] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/allcaps">
              <i class="fa fa-arrow-circle-right"></i> ALLCAPS</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[2] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/containsdigit">
              <i class="fa fa-arrow-circle-right"></i> CONTAINSDIGIT</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[3] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/alldigit">
              <i class="fa fa-arrow-circle-right"></i> ALLDIGIT</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[4] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/containsdots">
              <i class="fa fa-arrow-circle-right"></i> CONTAINSDOTS</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[5] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/lowercase">
              <i class="fa fa-arrow-circle-right"></i> LOWERCASE</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[6] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> PUNCTUATION</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[7] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/eightdigit">
              <i class="fa fa-arrow-circle-right"></i> EIGHTDIGIT</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[8] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/word">
              <i class="fa fa-arrow-circle-right"></i> WORD</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[9] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> LINE_START</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[10] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> LINE_IN</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[11] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> LINE_END</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[12] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> PERSON</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[13] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> ORGANIZATION</a>
          </li>
          <li>
            <a class="withripple <?php echo $menu3[14] ?>" href="<?php echo $lvl ?>ekstraksi-fitur/punctuation">
              <i class="fa fa-arrow-circle-right"></i> YEAR</a>
          </li>
        </ul>
      </li>
      <li id="e21">
        <a  class="withripple <?php echo $menu1[4] ?>" href="<?php echo $lvl."test" ?>">
          <i class="fa fa-bold"></i> Test
        </a>
      </li>
    </ul>
    <!-- ms-collapse-nav -->
  </div>
</div>
