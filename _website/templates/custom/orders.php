<main class="site__content">
            <div class="content">
                <div class="page-header bg-white">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="page-title text-center text-lg-left">Your Order History</h2>
                            </div>
                            <div class="col-lg-4">
                                <div class="row align-items-center quick-links quick-links--profile">
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="#" class="quick-links__item d-inline-block">
                                            <span class="quick-links__icon quick-links__icon--1 d-inline-block"></span>
                                            <h2 class="quick-links__title">Ongoing Tours</h2>
                                        </a>
                                    </div>
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="#" class="quick-links__item d-inline-block">
                                            <span class="quick-links__icon quick-links__icon--2 d-inline-block"></span>
                                            <h2 class="quick-links__title">Transfer</h2>
                                        </a>
                                    </div>
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="#" class="quick-links__item d-inline-block">
                                            <span class="quick-links__icon quick-links__icon--3 quick-links__icon--3-disabled d-inline-block"></span>
                                            <h2 class="quick-links__title">Trip Planner</h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content pt-0 pb-0">
                    <!-- <div class="section section--order-photo-list bg-gray">
                        <div class="container">
                            <div class="row order-photo-list">
                                <div class="col-lg-4 text-center order-photo-list__col">
                                    <img src="uploads/images/place-1.png" width="350" height="350" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-4 text-center order-photo-list__col">
                                    <img src="uploads/images/place-2.png" width="350" height="350" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-4 text-center order-photo-list__col">
                                    <img src="uploads/images/place-3.png" width="350" height="350" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php 
                    $g_cart = g_cart("payed");
                    ?>
                    <div class="section section--order-details">
                        <div class="container">
                            <div class="row order-details-headers text-center">
                                <div class="col-3"><?=l("tours")?></div>
                                <div class="col-3"><?=l("price")?></div>
                                <div class="col-3"><?=l("pickup")?></div>
                                <div class="col-3"><?=l("orderdate")?></div>
                            </div>
                            <?php 
                            $doubleWay = "";
                            $guests = "";
                            foreach($g_cart as $item): 
                                $title = $item['title'];
                                if($item["type"]=="transport"){
                                    $image1 = "http://odisisoftware.com/images/transport.png";
                                    
                                    
                                    if($item['startPlaceName2'] && $item['endPlaceName2']){
                                        $title = $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                        $guests = "<br />".$item["guests"]." ".l("passenger")."<br />";
                                        $guests .= $item["startPlaceName2"] . " - " . $item["endPlaceName2"];
                                        $guests .= "<br />".$item["guests2"]." ".l("passenger");                                    
                                    }else{
                                        $title = $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                        $guests = "<br />".$item["guests"]." ".l("passenger");
                                    }
                                    
                                }
                            ?>
                            <div class="order-details text-center">
                                <div class="row align-items-center">
                                    <div class="col-3"><?=$title?><?=$doubleWay.$guests?></div>
                                    <div class="col-3">
                                        <span class="tdprice"><?=$item['roud1_price']?></span>
                                        <span class="lari-symbol">l</span>
                                        <br />
                                        <?php if($item['roud2_price']>0): ?>
                                        <span class="tdprice"><?=$item['roud2_price']?></span>
                                        <span class="lari-symbol">l</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-3">
                                        <p><?=$item['startdate']?></p>
                                        <p><?=$item['timetrans']?></p>
                                        <?php if($item['roud2_price']>0): ?>
                                        <p><?=$item['startdate2']?></p>
                                        <p><?=$item['timetrans2']?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-3">
                                        <?=date("d-m-Y", $item['date'])?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- content -->