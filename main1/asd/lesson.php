
<?php include_once ('layout/head.php');?>
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <a class="box-studno">  <?php if(isset($_GET['r'])): ?>
                                <?php
                                $r = $_GET['r'];
                                if($r=='added'){  $classs='success';
                                }else if($r=='updated'){  $classs='warning';
                                }else if($r=='deleted'){ $classs='danger';
                                }else{  $classs='hide';
                                }
                                ?>
                                <div class="alert alert-dismissible alert-<?php echo $classs?> <?php echo $classs; ?>">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong>Successfully <?php echo $r; ?>!</strong>
                                </div>
                            <?php endif; ?></a>

                        <!--   <a   class="btn right btn-success  waves-effect waves-light yellow darken-4" data-toggle="modal" data-target="#add">   <i class="material-icons">add</i>ADD </a> -->
                        <h2>
                            <?php if($_GET['cat']=='1') { echo "Basic Concept of Hazard";
                            }elseif($_GET['cat']=='2') { echo "Basic Concept of Disaster and Disaster Risk";
                            }elseif($_GET['cat']=='3') { echo "Earthquake Hazards";
                            }elseif($_GET['cat']=='4') {echo "Volcano Hazards";
                            }elseif($_GET['cat']=='5'){ echo "Fire Hazards";
                            }?>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">

                            <?php if($_GET['cat']=='1') {
                                echo "<p>Hazard<br/>
A threatening incident, substance, humanactivityorconditionthatmaycause loss of life, injury or other health impacts, property casualty, loss of livelihoods and services, social and economic disruption, or environmentaldamage.
<br/><br/>
Disaster<br/>
Aseriousinterruptionofthefunctioningofa communityorasocietyinvolvingwidespread human, material, economic or environmental losses and impacts, which exceeds the ability of theaffected communityorsocietytocopeusingitsown resources.
<br/><br/>
Natural hazard<br/>
Natural process or incident that may cause loss of life, injury or other health impacts,propertydamage,lossoflivelihoods andservices,socialandeconomicdisruption, or environmentaldamage.
<br/><br/>
Technological hazards<br/>
A hazard originating from technologicalor industrial conditions, includingaccidents, dangerous procedures, infrastructure failuresorspecifichumanactivities,thatmay cause loss of life, injury, illness or other health impacts, property damage, loss of livelihoodsandservices,socialandeconomic disruption,orenvironmentaldamage.
 <br/><br/>
   Biological hazard<br/>
Processorincidentoforganicoriginor transmit by biological vectors, including exposure to pathogenic micro-organisms, toxins and bioactive substances that may cause loss of life, injury, illness or other health impacts, property casualty, loss of livelihoodsandservices,socialandeconomic disruption,orenvironmentaldamage.

<br/><br/>
Geological hazard<br/>
Geologicalprocessorincidentthatmay cause loss of life, injury or other health impacts,propertydamage,lossoflivelihoods andservices,socialandeconomicdisruption, or environmentaldamage.
<br/><br/>
Hydro-meteorological hazard<br/>
Process or phenomenon of atmospheric, hydrological or oceanographic nature that maycauselossoflife,injuryorotherhealth impacts,propertydamage,lossoflivelihoods andservices,socialandeconomicdisruption, or environmentaldamage.
</p>";
                            }elseif($_GET['cat']=='2') {
                                echo "<p>Disaster risk<br/>
Thepossibledisasterlosses,inlives,health status, livelihoods, assets and services, which could occur to an appropriatecommunityorasocietyoversomespecified future timeperiod.<br/><br/>

Risk<br/>
The combination of the probability of an event and its negative consequences.<br/><br/>
Capacity<br/>
The sequence of all the strengths, attributesandresourcesavailablewithina community,societyororganizationthatcan be used to attain agreed goals.<br/><br/>

Exposure<br/>
People, property, systems, or other elementspresentinhazardzonesthatare therebysubjecttopossiblelosses.<br/><br/>

Vulnerability<br/>
The aspects and circumstances of a community, system or asset that make it vulnerable to the damaging effects of a hazard.<br/><br/>
</p>";
                            }elseif($_GET['cat']=='3') {
                                echo "<p>DISCUSSION:<br/>

What is an earthquake?<br/><br/>

An EARTHQUAKE is a feeble shaking to uncontrollable trembling of the ground formed by the sudden movement of rocks or rock materials below the earth’s surface. There are two types of natural earthquakes: tectonic and volcanic earthquakes.
Tectonic earthquakes are generated by the sudden displacement along faults and plate boundaries. Earthquakes induced by rising lava or magma beneath active volcanoes is called volcanic earthquakes.
Some terms to remember:<br/>
The following are some basic concepts that should always be remembered:<br/>

Magnitude vs Intensity<br/>
<br/>
There are two ways by which we can measure the strength of an earthquake: magnitude and intensity. Magnitude is the measure of energy release and is determined based on instrumentally derived information. Magnitude correlates with the amount of total energy release at the earthquake’s point of origin and is reported as Arabic numbers for example magnitude 5.3 or 7.8. Intensity on the other hand is the description of how weak or strong the shaking is. The intensity is generally higher near the epicentre (reported as Roman Numerals e.g. I-Scarcely perceptible to X-Completely Devastating) and this is measured by what people see and feel (b) severity and extent of damage to building or structures; (c) condition of ground failure and presence of other earthquake hazards associated during the event. In the Philippines, the intensity of an earthquake is determined using the PHIVOLCS Earthquake Intensity Scale (PEIS).
<br/><br/>
Focus vs Epicenter<br/>

Focus is the point within the earth which is the center of energy released during an earthquake, while epicenter is the point on the surface of the earth directly above the focus.
<br/><br/>
Earthquake Hazards<br/>
There are hazards associated with earthquakes:<br/>

<br/>1.	Ground rupture – displacement on the ground due to the movement of fault. The movement may have vertical and horizontal component and may be as small as less than 0.5 meters (Masbate 2003 earthquake) to as big as 6 meters (16 July 1990 Earthquake).
<br/>2.	Ground shaking is the destructive up-down and sideways motion felt during an earthquake. Strong ground shaking can cause object to fall, break windows among others. Strong ground shaking can also result to minor damages to buildings and worse, cause collapse of a structure. (e.g. collapse of Hyatt Hotel, Baguio City after the 16 July 1990 Luzon earthquake).
<br/>3.	Liquefaction – is a process that transforms the behavior of a body of sediments from that of a solid to that of a liquid when subjected to extremely intense shaking. As a result, any heavy load on top of the sediment body will either sink or tilts as the sediment could no longer hold load, such as what happened in some buildings in Dagupan City during the 16 July 1990 earthquake.
<br/>4.	Earthquake-induced landslide - loose thin soil covering on the slopes of steep mountains are prone to mass movement, especially when shaken during an earthquake. Many landslides occur as a result of strong ground shaking such as those observed on the mountainsides along the National Highway in Nueva Ecija and the road leading up to Baguio City during the 16 July 1990 earthquake.
<br/>5.  Tsunami – is a series of sea waves generated by various geological processes and commonly  generated by under-the-sea earthquakes and whose heights could be greater than 5 meters. Example of recent tsunami events in the Philippines are the August 1976 Moro Gulf Earthquake and Tsunami and the November 1994 Oriental Mindoro Earthquake and Tsunami.
</p>";
                            }elseif($_GET['cat']=='4') {
                                echo "<p>DISCUSSION:<br/><br/>
What is a volcano?<br/>
The term volcano add up to a vent, hill, or mountain from which molten or hot rocks with gaseous materials are or have been ejected. The term also applies to craters, hills or mountains formed by removal of pre-existing materials of by accumulation of ejected materials. A volcanic eruption is a process wherein molten rock materials are emitted or ejected in the form of flowing masses of lava or fragmental particles called pyroclastic with gas from a crater, vent or fissure.
<br/><br/>
Types of Volcanoes<br/>
<br/>
There are different types of volcanoes based on the form or shape of their edifice, which are actually dependent upon the type of eruptions a volcano is capable of and ultimately the chemical composition of the magma it erupts.  Some of the general types of volcanoes are:
<br/><br/>a.	Monogenetic cones (tuff/cones, cinder cones, maars) – low symmetrical accumulations of cinder (scoria) and or tuff (ash). These volcanoes are usually associated with low silica or basaltic magma, usually for during just one eruption, and may be lateral vents associated with bigger volcanic complexes.
<br/>b.	Volcanic domes/ Domes complexes – mound-shaped or convex volcanoes formed by repeated slow extrusion of viscous magma. Domes are associated with low- to high silica magma e.g. Hibok-hibok Volcano
<br/>c.	Strato-volcanoes – cone-shaped volcanoes typically having one or several summit craters and formed by repeated alternate deposition of lava and pyroclastic. Stratovolcanoes are usually formed by intermediate silica or andesitic magma . e.g. Mayon Volcano.
<br/>d.	Calderas – large volcanic edifices typically composed of several volcanic centers around a central 2 km wide crater. Calderas are formed by highly explosive eruptions in between long periods of dormancy and are typically associated with high-silica or rhyolitic magma, e.g. Taal Caldera
<br/><br/>
Types of Volcanic Eruptions<br/>

<br/>Volcanic eruptions are commonly classified as wet or dry eruptions depending on the role of water. More popularly however, volcanic eruptions are characterized according to the behaviour or styles of activity. The most common types of eruptions are:
<br/><br/>a.	Phreatic or hydrothermal eruptions – steam-driven eruptions caused by the contact of water with hot country rocks (not magma). Phreatic eruptions are short-lived, producing only ephemeral ash columns, but may be precursory to larger eruptive activity.

<br/>b.	Phreatomagmatic eruptions – very violent eruptions generated by the explosive contact of erupting magma with water. These eruptions produce voluminous columns of very fine ash and, more importantly, laterally projected, high-speed and hazardous pyroclastic currents called base surges.

<br/>c.	Strombolian eruptions – periodic weak to violent eruptions of gas-charges fluid lava characterized by lava fountaining and flow.

<br/>d.	Vulcanian eruptions – canon-like explosions produced by the detonation of a solidified plug of magma in the volcanic conduit by pressurized accumulated gas beneath it. Vulcanian eruptions are characterized by tall eruption columns that can reach up to 20 km high and the generation of pyroclastic flows and ashfall tephra.

<br/>e.	Plinian eruptions – sustained and excessively explosive eruption of voluminous gas and pyroclastic that produce tall eruption columns in excess of 40 km and well- pronounced umbrella clouds. Plinian eruptions produce caldera but more importantly, voluminous pyroclastic flows that often form widespread sheets of deposits called an ignimbrite field. These eruption are known to cause global climactic changes due to the injection of large quantities of volcanic gas into the stratosphere.

</p>";
                            }elseif($_GET['cat']=='5'){
                                echo "<p>Understanding Fire!<br/>
	Fire is a chemical reaction. It is the rapid oxidation of fuel producing heat and light. For fire to occur, all other must be present: Heat, Fuel, Oxygen.
<br/>
Fire Hazards: What you should watch out for<br/>
<br/>
A.	Kitchen Area<br/>
<br/>•	NEVER leave your kitchen while cooking!
<br/>•	Matches and lighters should be in proper storage and away from children’s reach.
<br/>•	Keep your stove clean and grease-free, and check your LPG for leaks with soapy water.
<br/>•	When frying and your pan bursts into flame, DO NOT douse it with WATER. Put the lid on or get a wet damp cloth to cover the pan.
<br/>•	Idle electrical appliances must be unplugged.
<br/>•	Avoid overloading of outlets and use of worn cords.
<br/>•	Do not store items above the stove top.
<br/>•	Keep flammable liquids and other combustible items away from the stove when cooking.
<br/>•	Ensure that your smoke alarms are working
<br/>well and replace batteries at least every six months.
<br/><br/>
B.  Living Rooms and Bathrooms<br/>
<br/>•	Do not use extension cords as permanent outlets. Make sure that extension cords are not looped on sharp objects that could cause it to fray.
<br/>•	Make sure that curtains are away from electric fan blades
<br/>•	DO NOT leave an electric fan switched on when it is not rotating! Clean and oil them regularly.
<br/>•	Defective appliances must be fixed immediately.
<br/>•	Take extra care when using a clothes iron or rice cooker.<br/>
Unplug them promptly after use.
<br/>•	NEVER SMOKE IN BED!
<br/>•	Put out candle lights before going to bed.
<br/>•	Place a lit candle in a holder. If you have none, place it in the middle of a basin partly filled with water.
<br/>•	Keep your place clean at all times. Remove dried leaves, cobwebs, loose paper, and other easy-burning debris.

<br/><br/>

C. Storage and Garage Areas<br/>
<br/>•	Keep areas clean and tidy with items properly placed for storage.
<br/>•	Do not store large quantities of flammable liquids in the house and basement areas.
<br/>	Gas/kerosene
<br/>	Paints and solvents
<br/>	Motor lubricants
<br/>	Floor wax/ liquid polishes
<br/>	Adhesives (Rugby)
<br/>	Alcohol products
<br/>•	Oily rags, newspaper and other trash must be disposed in a sage waste bag or container.
<br/>•	Clean up spilled oil and grease from vehicles promptly.
<br/>•	Plug your power tools straight to the wall socket. Use only heavy-duty extensions when needed.
<br/>•	Keep your garage well-ventilated to avoid build-up of fumes and heat from tools.
<br/><br/>
INFO: Why should you unplug idle appliances?<br/>
Can you guess how many appliances are plugged in your house at the moment?
<br/><br/>
Many of the electronic devices in your home are quietly drawing electricity all the time, whether you are using them or not. As much as ten (10%) more energy is drawn by an appliance on standby mode. Imagine how much you can save when you unplug them after use.
<br/><br/>
Despite all the safety features of modern appliances, a risk of overheat is always present, which could also lead to household fires.
<br/><br/>
There are new smart power strips/extension cords that you could purchase at specialty hardware stores. They automatically monitor your power usage and shuts off power supply so you could avoid the inconvenience of removing your plugs every time.
<br/><br/>
Below is a list of things to remember if there is a fire. Study it well. These tips could make all the difference for you and your family!
<br/>
<br/>•	Make sure everyone in your household knows where and how to evacuate to
<br/>•	Always take part in fire drills
<br/>•	Plan more than one way to exit your location
<br/>•	Never leave fire unattended
<br/>•	Make sure all fire tools are easy to access
<br/>•	If you are advised to evacuate, leave immediately
<br/>•	If you are not trained and equipped to fight a fire, don’t risk your life
<br/>•	When there is a fire, before opening a door
<br/>•	Check to see if there is heat or smoke coming through cracks around the door. If yes, do not open!
<br/>•	Touch the door and doorknob. If it is hot, do not open!
<br/>•	If the door is cool, open carefully and follow your escape route
<br/>•	Keep close to the ground – there is less smoke there
<br/>•	Even if you’re scared, never hide from fire fighters – they will not find you!
<br/>•	Regularly check that your fire alarm is working
<br/>•	If your clothes catch fire, stop, drop to the ground, cover your face with your hands, and roll.
</p>";

                            }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>

<?php include_once ('layout/footer.php');?>
