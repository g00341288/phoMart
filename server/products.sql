# A simple transaction (without rollback) to populate the products table for demonstration
# purposes
START TRANSACTION;

# create a product record
INSERT INTO product(additional_features, os, ui, availability, battery_standbytime, 
	battery_talktime, battery_type, camera_flash, camera_video, camera_primary, connectivity_bluetooth, 
	connectivity_cell, connectivity_gps, connectivity_infrared, connectivity_wifi, description, 
	display_resolution, display_size, display_touchscreen, hardware_accelerometer, hardware_audiojack,
	hardware_cpu, hardware_fmradio, hardware_physicalkeyboard, hardware_usb, image_0, image_1, image_2,
	image_3, image_4, name, dimensions_w, dimensions_h, dimensions_l, weight_grams, storage_flash,
	storage_ram, added)
VALUES(
	"Front-facing 1.3MP camera", 
	"Android 2.2", 
	"Dell Stage", 
	"T-Mobile", 
	"", 
	"", 
	"Lithium Ion (Li-Ion) (2780 mAH)", 
	true, 
	true, 
	"5.0 megapixels", 
	"Bluetooth 2.1", 
	"T-mobile HSPA+ @ 2100/1900/AWS/850 MHz", 
	true, 
	false, 
	"802.11 b/g", 
	"Introducing Dell\u2122 Streak 7. Share photos, videos and movies together. 
	It\u2019s small enough to carry around, big enough to gather around. 
	Android\u2122 2.2-based tablet with over-the-air upgrade capability for future OS releases.  
	A vibrant 7-inch, multitouch display with full Adobe\u00ae Flash 10.1 pre-installed.  
	Includes a 1.3 MP front-facing camera for face-to-face chats on popular services such as Qik or Skype.  
	16 GB of internal storage, plus Wi-Fi, Bluetooth and built-in GPS keeps you in touch with the world around you.  
	Connect on your terms. Save with 2-year contract or flexibility with prepaid pay-as-you-go plans!", 
	"WVGA (800 x 480)",
	"7.0 inches", 
	true, 
	true, 
	"3.5mm", 
	"nVidia Tegra T20", 
	false, 
	false, 
	"USB 2.0", 
	"img/phones/dell-streak-7.0.jpg", 
	"img/phones/dell-streak-7.1.jpg", 
	"img/phones/dell-streak-7.2.jpg", 
	"img/phones/dell-streak-7.3.jpg", 
	"img/phones/dell-streak-7.4.jpg", 
	"Dell Streak 7", 
	199.9, 
	119.8, 
	12.4, 
	450, 
	"16000MB", 
	"512MB", 
	CURRENT_TIMESTAMP()
	 );

# create a product record
INSERT INTO product(additional_features, os, ui, availability, battery_standbytime, 
	battery_talktime, battery_type, camera_flash, camera_video, camera_primary, connectivity_bluetooth, 
	connectivity_cell, connectivity_gps, connectivity_infrared, connectivity_wifi, description, 
	display_resolution, display_size, display_touchscreen, hardware_accelerometer, hardware_audiojack,
	hardware_cpu, hardware_fmradio, hardware_physicalkeyboard, hardware_usb, image_0, image_1, image_2,
	image_3, image_4, name, dimensions_w, dimensions_h, dimensions_l, weight_grams, storage_flash,
	storage_ram, added)
VALUES(
	"Gorilla Glass display, Dedicated Camera Key, Ring Silence Switch, Swype keyboard.", 
	"Android 2.2", 
	"Dell Stage", 
	"AT&T, KT, T-Mobile", 
	"400 hours", 
	"7 hours", 
	"Lithium Ion (Li-Ion) (1400 mAH)", 
	true, 
	true, 
	"8.0 megapixels", 
	"Bluetooth 2.1", 
	"850/1900/2100 3G; 850/900/1800/1900 GSM/GPRS/EDGE\n900/1700/2100 3G; 850/900/1800/1900 GSM/GPRS/EDGE", 
	true, 
	false, 
	"802.11 b/g", 
	"The Venue is the perfect one-touch, Smart Phone providing instant access to everything you love. All of 
	Venue's features make it perfect for on-the-go students, mobile professionals, and active social communicators 
	who love style and performance.\n\nElegantly designed, the Venue offers a vibrant, curved glass display that\u2019s 
	perfect for viewing all types of content. The Venue\u2019s slender form factor feels great in your hand and also 
	slips easily into your pocket.  A mobile entertainment powerhouse that lets you download the latest tunes from 
	Amazon MP3 or books from Kindle, watch video, or stream your favorite radio stations.  All on the go, anytime, 
	anywhere.",
	"WVGA (800 x 480)",
	"4.1 inches", 
	true, 
	true, 
	"3.5mm", 
	"1 Ghz processor", 
	false, 
	false, 
	"USB 2.0", 
	"img/phones/dell-venue.0.jpg", 
	"img/phones/dell-venue.1.jpg", 
	"img/phones/dell-venue.2.jpg", 
	"img/phones/dell-venue.3.jpg", 
	"img/phones/dell-venue.4.jpg", 
	"Dell Venue",
	64.0, 
	121.0, 
	12.9, 
	164.0, 
	"1000MB", 
	"512MB", 
	CURRENT_TIMESTAMP()
	 );

# create a product record
INSERT INTO product(additional_features, os, ui, availability, battery_standbytime, 
	battery_talktime, battery_type, camera_flash, camera_video, camera_primary, connectivity_bluetooth, 
	connectivity_cell, connectivity_gps, connectivity_infrared, connectivity_wifi, description, 
	display_resolution, display_size, display_touchscreen, hardware_accelerometer, hardware_audiojack,
	hardware_cpu, hardware_fmradio, hardware_physicalkeyboard, hardware_usb, image_0, image_1, image_2,
	image_3, image_4, name, dimensions_w, dimensions_h, dimensions_l, weight_grams, storage_flash,
	storage_ram, added)
VALUES(
	"Adobe Flash Player 10, Quadband GSM Worldphone, Advance Business Security, Complex Password Secure, 
	Review & Edit Documents with Quick Office, Personal 3G Mobile Hotspot for up to 5 WiFi enabled Devices, 
	Advanced Social Networking brings all social content into a single homescreen widget",  
	"Android 2.2", 
	"", 
	"Verizon", 
	"230 hours", 
	"8 hours", 
	"Lithium Ion (Li-Ion) (1400 mAH)", 
	true, 
	true, 
	"5.0 megapixels", 
	"Bluetooth 2.1", 
	"WCDMA 850/1900/2100, CDMA 800/1900, GSM 850/900/1800/1900, HSDPA 10.2 Mbps 
        (Category 9/10), CDMA EV-DO Release A, EDGE Class 12, GPRS Class 12, HSUPA 1.8 Mbps", 
	true, 
	false, 
	"802.11 b/g/n", 
	"With Quad Band GSM, the DROID 2 Global can send email and make and receive calls 
    from more than 200 countries. It features an improved QWERTY keyboard, super-fast 1.2 GHz processor 
    and enhanced security for all your business needs.",
	"FWVGA (854 x 480)",
	"3.7 inches", 
	true, 
	true, 
	"3.5mm", 
	"1.2 GHz TI OMAP", 
	false, 
	true, 
	"USB 2.0", 
	"img/phones/droid-2-global-by-motorola.0.jpg", 
  "img/phones/droid-2-global-by-motorola.1.jpg", 
  "img/phones/droid-2-global-by-motorola.2.jpg",
  "",
  "", 
	"DROID\u2122 2 Global by Motorola",
	60.5, 
	116.3, 
	13.7, 
	169.0, 
	"8192MB", 
	"512MB", 
	CURRENT_TIMESTAMP()
	 );

# create a product record
INSERT INTO product(additional_features, os, ui, availability, battery_standbytime, 
	battery_talktime, battery_type, camera_flash, camera_video, camera_primary, connectivity_bluetooth, 
	connectivity_cell, connectivity_gps, connectivity_infrared, connectivity_wifi, description, 
	display_resolution, display_size, display_touchscreen, hardware_accelerometer, hardware_audiojack,
	hardware_cpu, hardware_fmradio, hardware_physicalkeyboard, hardware_usb, image_0, image_1, image_2,
	image_3, image_4, name, dimensions_w, dimensions_h, dimensions_l, weight_grams, storage_flash,
	storage_ram, added)
VALUES(
	"Multiple messaging options, including text with threaded messaging for organized, 
  easy-to-follow text; Social Community support, including Facebook and MySpace; 
  Next generation Address book; Visual Voice Mail\n, 3.0 megapixel camera, and more",  
	"Android 2.2", 
	"MOTOBLUR", 
	"AT&T", 
	"400 hours", 
	"5 hours", 
	"Lithium Ion (Li-Ion) (1930 mAH)", 
	true, 
	true, 
	"3.0 megapixels", 
	"Bluetooth 2.1", 
	"WCDMA 850/1900/2100, GSM 850/900/1800/1900, HSDPA 14Mbps (Category 10) Edge Class 12, 
   GPRS Class 12, eCompass, AGPS", 
	true, 
	false, 
	"802.11 a/b/g/n", 
	"MOTOROLA ATRIX 4G gives you dual-core processing power and the revolutionary webtop 
    application. With webtop and a compatible Motorola docking station, sold separately, you can surf the 
    Internet with a full Firefox browser, create and edit docs, or access multimedia on a large screen 
    almost anywhere.",
	"QHD (960 x 540)",
	"4.0 inches", 
	true, 
	true, 
	"3.5mm", 
	"1 GHz Dual Core", 
	false, 
	true, 
	"USB 2.0", 
	"img/phones/motorola-atrix-4g.0.jpg", 
	"img/phones/motorola-atrix-4g.1.jpg", 
	"img/phones/motorola-atrix-4g.2.jpg", 
	"img/phones/motorola-atrix-4g.3.jpg",
  "", 
	"MOTOROLA ATRIX\u2122 4G",
	63.5, 
	117.75, 
	10.95, 
	135.0, 
	"8192MB", 
	"1024MB", 
	CURRENT_TIMESTAMP()
	);

# create a product record
INSERT INTO product(additional_features, os, ui, availability, battery_standbytime, 
	battery_talktime, battery_type, camera_flash, camera_video, camera_primary, connectivity_bluetooth, 
	connectivity_cell, connectivity_gps, connectivity_infrared, connectivity_wifi, description, 
	display_resolution, display_size, display_touchscreen, hardware_accelerometer, hardware_audiojack,
	hardware_cpu, hardware_fmradio, hardware_physicalkeyboard, hardware_usb, image_0, image_1, image_2,
	image_3, image_4, name, dimensions_w, dimensions_h, dimensions_l, weight_grams, storage_flash,
	storage_ram, added)
VALUES(
	"3.2\u201d Full touch screen with Advanced anti smudge, anti 
  reflective and anti scratch glass; Swype text input for easy and fast message creation; 
  multiple messaging options, including text with threaded messaging for organized, 
  easy-to-follow text; Social Community support, including Facebook and MySpace; 
  Next generation Address book; Visual Voice Mail\n",  
	"Android 2.1", 
	"TouchWiz", 
	"Cellular South", 
	"800 hours", 
	"7 hours", 
	"Nickel Cadmium (NiCd) (1500 mAH)", 
	true, 
	true, 
	"3.0 megapixels", 
	"Bluetooth 3.0", 
	"3G/CDMA : 850MHz/1900MHz\n", 
	true, 
	false,
	"802.11 b/g",  
	"The Samsung Gem\u2122 maps a route to a smarter mobile experience. 
  By pairing one of the fastest processors in the category with the Android\u2122 
  platform, the Gem delivers maximum multitasking speed and social networking 
  capabilities to let you explore new territory online. A smart phone at an even 
  smarter price is a real find, so uncover the Gem and discover what\u2019s next.",
	"WQVGA (400 x 240)",
	"3.2 inches", 
	true, 
	true, 
	"3.5mm", 
	"800 MHz", 
	false, 
	true, 
	"USB 2.0", 
	"img/phones/motorola-atrix-4g.0.jpg", 
	"img/phones/samsung-gem.0.jpg", 
	"img/phones/samsung-gem.1.jpg", 
	"img/phones/samsung-gem.2.jpg",
	"", 
	"Samsung Gem\u2122",
	55.5, 
	113.0, 
	12.4, 
	110.0, 
	"1024MB", 
	"1024MB", 
	CURRENT_TIMESTAMP()
	);

COMMIT;