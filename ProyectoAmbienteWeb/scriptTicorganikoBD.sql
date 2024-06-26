/*Se crea la base de datos */
drop schema if exists ticorganiko;
drop user if exists usuario;
CREATE SCHEMA ticorganiko ;

/*Se crea un usuario para la base de datos llamado "usuario" y tiene la contraseña "clave."*/
create user 'usuario'@'%' identified by 'clave';

/*Se asignan los prvilegios sobr ela base de datos ticorganiko al usuario creado */
grant all privileges on ticorganiko.* to 'usuario'@'%';
flush privileges;

use ticorganiko;

-- Crear la tabla de clientes
CREATE TABLE cliente (
  id_cliente INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(35) NOT NULL,
  correo VARCHAR(30) NOT NULL,
  numero_telefono INT,
  direccion VARCHAR(120),
  cedula INT NOT NULL,
  username VARCHAR(15) NOT NULL,
  password VARCHAR(512) NOT NULL,
  ruta_imagen VARCHAR(1024),
  activo BOOLEAN,
  PRIMARY KEY (id_cliente))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4;
  
   create table categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL,
    ruta_imagen VARCHAR(1024)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

-- Crear la tabla de productos
CREATE TABLE productos (
  id_producto INT NOT NULL AUTO_INCREMENT,
  nombreProducto VARCHAR(30) NOT NULL,
  descripcion VARCHAR(350) NOT NULL,
  id_categoria INT NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  codigo VARCHAR(6) NOT NULL,
  promocion DECIMAL(10, 2),
  activo BOOLEAN,
  ruta_imagen VARCHAR(1024),
  PRIMARY KEY (id_producto),
  FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

-- Crear la tabla de pedidos para el apartado de carrito
CREATE TABLE pedidos (
  id_pedido INT NOT NULL AUTO_INCREMENT,
  id_cliente INT NOT NULL,
  PRIMARY KEY (id_pedido),
  FOREIGN KEY fk_pedido_cliente (id_cliente) REFERENCES cliente(id_cliente)
) ENGINE = InnoDB 
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE pedidos_productos (
  id_pedido_producto INT NOT NULL AUTO_INCREMENT,
  id_pedido INT NOT NULL,
  id_producto INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  cantidad INT NOT NULL,
  monto_total DECIMAL(10,2) NOT NULL,
  fecha_compra DATETIME,
  PRIMARY KEY (id_pedido_producto),
  FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
  FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
) ENGINE =InnoDB DEFAULT CHARACTER SET=utf8mb4;

create table rol (
  id_rol INT NOT NULL AUTO_INCREMENT,
  id_cliente INT NOT NULL,
  nombre VARCHAR(20),
  PRIMARY KEY (id_rol),
  FOREIGN KEY fk_rol_cliente (id_cliente) REFERENCES cliente(id_cliente)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Dulces', 'https://www.superaki.mx/cdn/shop/collections/DULCES.png?v=1634682356');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Bebidas', 'img/bebidas.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Cereales', 'https://cloudfront-us-east-1.images.arcpublishing.com/gruponacion/6EONPOUOJNHWXPLT7OTC7UP2I4.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Frutas', 'https://www.loreki.com/wp-content/uploads/2014/09/frutas.propiedades.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Carnes', 'https://i.blogs.es/a6a88d/1366_20001/450_1000.webp');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Verduras', 'https://libroderecetas.com/files/recetas/vegetales-en-cocina.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Chocolates', 'https://www.thespruceeats.com/thmb/FhHcgQni8lgV0griUeDJMTAszxI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/chocolate_hero1-d62e5444a8734f8d8fe91f5631d51ca5.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Embutidos', 'https://imgmedia.buenazo.pe/600x338/buenazo/original/2023/01/03/63b46e1847deb8340e430774.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Congelados', 'https://fuentesmar.es/wp-content/uploads/2020/10/tranquility-Landscape_Pics_HD_Wallpaper_2560x1600.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Panaderia', 'https://www.ocu.org/-/media/ocu/images/home/alimentacion/alimentos/panes/panes-guia-compra.jpg?rev=9a1e9247-e398-4c0f-b489-d01d95a221ad&hash=E5149953335F3DC2129A9B495E89DF51');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Lacteos', 'https://www.webconsultas.com/sites/default/files/styles/wc_adaptive_image__small/public/articulos/productos-lacteos.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Licores', 'https://kr.imboldn.com/wp-content/uploads/2023/05/01-768x432.jpg');
INSERT INTO categorias (nombre_categoria, ruta_imagen) VALUES ('Prueba', 'img/bebidas.jpg');


INSERT INTO cliente (id_cliente, nombre, correo, numero_telefono, direccion, cedula, username, password, ruta_imagen, activo) VALUES
(1, 'Juan Carlos Morales Silva', 'Juan1234@gmail.com', 123456789, ' San Jose - Residencial Los Pinos, Calle 5', 184720483, 'juan12', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://www.afondochile.cl/site/wp-content/uploads/2018/06/jose-vaisman-e1529942487664.jpg', true),
(2, 'Ana María Silva Flores', 'Ana5322@gmail.com', 123456789, 'Heredia - Residencial La Floresta, Calle Principal', 123456789, 'ana_maria53', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://ab-innovativesolutions.com/wp-content/uploads/sites/5/2019/09/Persona-1-445x445.jpg', true),
(3, 'Isabella Ruiz Vargas', 'Isabella1732@gmail.com', 123456789, 'San Jose - Residencial El Bosque, Calle Amapola', 123456789, 'isabella17', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://media.biobiochile.cl/wp-content/uploads/2019/02/captura-realizada-el-2019-02-25-17-21-56.png', true),
(4, 'Adrian García López', 'Adrian9472@gmail.com', 123456789, 'San Jose - Condominio San Gabriel, Calle 10', 123456789, 'adrian94', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://media.biobiochile.cl/wp-content/uploads/2019/02/captura-realizada-el-2019-02-25-15-37-02.png', true),
(5, 'Sofia Rodríguez Mendoza', 'Valentina4723@gmail.com', 123456789, 'Puntarenas - Residencial Marítimo, Calle del Mar', 123456789, 'valentina47', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://cdnb.20m.es/sites/112/2019/04/cara6.jpg', true),
(6, 'Daniel Castro Jiménez', 'Daniel4726@gmail.com', 123456789, 'San Jose -  Montañas Verdes, Ruta 243', 123456789, 'daniel14', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(7, 'Sofia Díaz Ramírez', 'Sofia9214@gmail.com', 123456789, 'Puntarenas - Urbanización Las Acacias', 123456789, 'sofia92', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(8, 'Marcos Camacho Arguedas', 'Marcos3746@gmail.com', 123456789, 'Limon - Residencial Caribe, Calle Palmeras', 123456789, 'marcos37', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(9, 'Alberto Carballo Hernandez', 'Alberto8362@gmail.com', 123456789, 'Guanacaste - Oasis del Mar', 123456789, 'alberto83', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(10, 'Natalia Flores González', 'Natalia8273@gmail.com', 123456789, 'San Jose - Altos de Escazú, Callejon de las Flores', 123456789, 'natalia82', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(11, 'Andres Herrera Ruiz', 'Andres2341@gmail.com', 123456789, 'San Jose - Valle del Sol, Calle 25', 123456789, 'andres23', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(12, 'Javier Torres Martínez', 'Javier2936@gmail.com', 123456789, 'Alajuela - Jardines del Norte, Avenida de las Flores', 123456789, 'javier29', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(13, 'Lucia Ramírez González', 'Lucia7362@gmail.com', 123456789, 'Cartago - La Hacienda, Paseo de los Alamos', 123456789, 'lucia73', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(14, 'Eduardo González Pérez', 'Eduardo9428@gmail.com', 123456789, 'Limon - Costa Caribe, Pase del Mar', 123456789, 'eduardo94', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true),
(15, 'Laura Sánchez García', 'Laura2345@gmail.com', 123456789, 'Tibas - Santa Rosa, Avenida 10', 123456789, 'laura23', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://i.pinimg.com/280x280_RS/42/03/a5/4203a57a78f6f1b1cc8ce5750f614656.jpg', true);

INSERT INTO ticorganiko.rol (id_rol, nombre, id_cliente) VALUES 
(1,'ROLE_ADMIN',1), (2,'ROLE_USER',1),
(3,'ROLE_ADMIN',2), (4,'ROLE_USER',2),
(5,'ROLE_ADMIN',3), (6,'ROLE_USER',3),
(7,'ROLE_ADMIN',4), (8,'ROLE_USER',4),
(9,'ROLE_ADMIN',5), (10,'ROLE_USER',5),
(11,'ROLE_USER',6),
(12,'ROLE_USER',7),
(13,'ROLE_USER',8),
(14,'ROLE_USER',9),
(15,'ROLE_USER',10),
(16,'ROLE_USER',11),
(17,'ROLE_USER',12),
(18,'ROLE_USER',13),
(19,'ROLE_USER',14),
(20,'ROLE_USER',15);

-- Insertar datos para la categoría Dulces
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES 
  ('PushPops', 'PushPops es una marca de paletas de caramelo con un envase cilíndrico que se empuja desde abajo para consumir fácilmente.', 1, 450, 'CH74J2', NULL, TRUE, 'https://i5.walmartimages.com/seo/Jumbo-Push-Pop-Assorted-Flavor-Spring-Lollipop-1-06oz_b253883d-fb42-4627-8dd2-e31454ff5e84.8e0d92e5320a5b030106f04b5bbb8d3d.jpeg'),
  ('Snickers', 'Snickers es una barra de chocolate con relleno de mani y caramelo, cubierta con chocolate.', 1, 350, 'GAU39D', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/287993/Chocolate-Snickers-Original-52-7gr-1-27216.jpg?v=637808279270500000'),
  ('Morenitos', 'Morenitos son dulces de chocolate con leche y coco, muy populares en algunas regiones de América Latina.', 1, 150, 'CAY38C', NULL, TRUE, 'https://www.ticoshopping.com/cdn/shop/products/Capturadepantalla2022-11-30ala_s_11.19.50.png?v=1669828812'),
  ('Barrilete', 'Barrilete son caramelos con sabor a fruta en forma de barril, muy populares en algunas regiones, especialmente en Latinoamérica.', 1, 200, 'PA194H', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/564621/Caramelo-Super-Barrilete-Sabor-Fruta-400gr-1-31710.jpg?v=638458768116630000'),
  ('Chiky Mix de Galletas', 'Una crujiente galleta de vainilla con deliciosa cobertura con sabor de chocolate, La empresa Pozuelo lanzó una nueva oferta de galletas para el 2024, que incluye nuevas versiones de sus clásicas Chiky y Cremas, así como el retorno de las Toby.', 1, 9450.00, 'PA194H', 6950.00, TRUE, 'img/articuloPromocion1.jpeg');

-- Insertar datos para la categoría Bebidas
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES 
  ('CocaCola', 'Coca Cola es una bebida azucarada gaseosa vendida a nivel mundial en tiendas, restaurantes y máquinas expendedoras en más de doscientos países o territorios. Es el principal producto de The Coca-Cola Company, de origen estadounidense.', 2, 3050.40, '6XRSW8', 2150.00, TRUE, 'https://i5.walmartimages.ca/images/Enlarge/-bo/tle/coca-cola-2-liter-botle.jpg'),
  ('Fanta Kolita', 'Fanta Kolita es una bebida espumosa con una suave mezcla de frutas exóticas y florales. Su carácter dulce y ligeramente ácido puede recordarte a la granadina.', 2, 693.40, 'AM01JS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/463807/Gaseosa-Fanta-kolita-regular-600-ml-1-26343.jpg?v=638328299959800000'),
  ('Te Frio', 'La producción industrial de frescos de frutas naturales en Costa Rica se inició en el año 2001, cuando Florida Bebidas transformó el mercado nacional al introducir los frescos de frutas y los tés fríos Tropical.', 2, 3254.00, 'CF3DI4', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/353783/Refresco-Tropical-T-Frio-Lim-n-3000ml-1-55580.jpg?v=638018230229930000'),
  ('Pepsi', 'Pepsi es una famosa bebida carbonatada de cola originaria de Estados Unidos. Nace en Carolina del Norte, en 1898, inventada por Caleb B. Bradham, un químico farmacéutico que quería crear un refresco delicioso que ayudara a la digestión y fuera un estimulante.', 2, 1904.00, 'J29NKE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/379645/Bebida-Gasificada-Pepsi-Cola-Pet-600ml');

-- Insertar datos para la categoria Cereales
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Zucaritas de Chocolate', 'Zucaritas de Chocolate: Deliciosas cereales crujientes cubiertas de chocolate para un desayuno lleno de sabor y energía.', 3, 3850.00, 'J29NKE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/302327/Cereal-Kellogg-s-Zucaritas-Sabor-Chocolate -con-Malvaviscos-Hojuelas-de-Ma-z-Escarchadas-con-Sabor-a-Chocolate-y-con-Malvaviscos-1-Caja-de-700gr-1-34575.jpg?v=637848670993100000'),
('Naranitas', 'Naranitas: Delicioso cereal de maíz con sabor a naranja, perfecto para un desayuno refrescante y lleno de energía para comenzar tu día con un toque cítrico y delicioso', 3, 4000.00, 'J29NKE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/212316/Cereal-Naranitas-Jacks-760gr-2-35630.jpg?v=637601655401900000'),
('Poffis', 'Poffis: Crujientes y deliciosos cereales inflados, ideales para un desayuno ligero y sabroso. Con su textura ligera y su sabor agradable, Poffis es la opción perfecta para comenzar tu día con energía y buen gusto.', 3, 1800.00, 'J29NKE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/359280/Cereal-Jacks-Poffis-Zipper-500gr-2-74680.jpg?v=638031730205470000'),
('Nesquik', 'Nesquik: El cereal perfecto para los amantes del chocolate. Con sus crujientes hojuelas y su sabor a chocolate irresistible, Nesquik hace que cada desayuno sea una deliciosa experiencia que te encantará.', 3, 2340.00, 'J29NKE', NULL, TRUE, 'https://www.nestle-cereals.com/co/sites/g/files/qirczx971/files/2022-09/Nesquik.png');

-- Insertar datos para la categoria Frutas
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Manzanas', 'Manzanas: Frutas frescas y jugosas, conocidas por su sabor dulce y crujiente. Con una amplia variedad de colores y sabores, las manzanas son una opción deliciosa y nutritiva para cualquier momento del día.', 4, 450.00, 'THY78', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/222383/Manzana-Roja-Unidad-1-47451.jpg?v=637626941051730000'),
('Uvas', 'Uvas: Pequeñas y jugosas, las uvas son frutas que ofrecen un sabor dulce y refrescante. Disponibles en una variedad de colores y sabores, las uvas son perfectas para comer solas como refrigerio o como ingrediente en ensaladas y postres', 4, 2490.00, 'SDRT32', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/427753/Uva-Verde-Empacado-500gr-2-26260.jpg?v=638266093715030000'),
('Peras', 'Peras: Frutas de forma redondeada y textura suave, conocidas por su sabor dulce y jugoso. Las peras son una excelente fuente de fibra y nutrientes, y se pueden disfrutar frescas, en ensaladas o cocidas como parte de platos dulces y salados.', 4, 500.00, 'TFAAA8', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/323194/Pera-Verde-Unidad-1-36295.jpg?v=637916926401700000'),
('Mangos', 'Mangos: Frutas tropicales con una pulpa suave y jugosa, conocidas por su sabor dulce y aroma exótico. Los mangos son versátiles y se pueden disfrutar frescos, en batidos, ensaladas
 de frutas o como ingrediente en platos salados y postres.', 4, 950.00, 'RTEF43', NULL, TRUE, 'https://i5.walmartimages.com/seo/Fresh-Mangoes-Each-Sweet_cc54242f-cb87-4a25-9baa-fccaa20f5443.64fa79325ad44a7352dcd3c2a8b477be.jpeg');

-- Insertar datos para la categoria Carnes
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Carne Molida', 'Un ingrediente versátil y sabroso, perfecto para una amplia variedad de platos. Con su textura suave y jugosa, la carne molida es ideal para preparar hamburguesas, albóndigas, lasañas, tacos y muchos otros platillos deliciosos.', 5, 4150.00, 'HGBD0', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/338819/Molida-Res-Premium-No-Mas-10-Grasa-Tf-Kg-1-58514.jpg?v=637976651108370000'),
('Fajitas de Pollo', 'Una deliciosa combinación de carne sazonada, verduras frescas y tortillas calientes, típica de la cocina mexicana. Las fajitas son una opción sabrosa y saludable, perfecta para disfrutar en reuniones familiares o con amigos.', 5, 3500.00, '1GEBS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/529764/Fajitas-De-Pollo-Don-Cristobal-Empacado-Precio-indicado-por-Kilo-2-33412.jpg?v=638419990466100000'),
('Pescado', 'Una fuente nutritiva y deliciosa de proteínas, omega-3 y otros nutrientes esenciales. Con su textura suave y sabor fresco, el pescado es una opción saludable y versátil que se puede disfrutar horneado, a la parrilla, frito o en sopas y guisos.', 5, 7520.00, '0LJB4', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/182234/Filete-Tilapia-Altamar-Congelada-2-3Kg-1-39260.jpg?v=637548157876500000'),
('Carne de Res', 'Carne de res de alta calidad, conocida por su sabor jugoso y textura tierna. La carne de res es versátil y se puede preparar de muchas formas, desde jugosas hamburguesas y filetes a la parrilla hasta guisos reconfortantes y platos tradicionales de cocina.', 5, 7000.00, '0OLSP', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/173515/Lomo-Don-Cristobal-Ancho-De-Res-Tenderizado-1kg-1-44327.jpg?v=637538994216930000');
  
-- Insertar datos para la categoria Verduras
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Chile Dulce', 'Un pimiento suave y sabroso, conocido por su sabor dulce y textura crujiente. El chile dulce es un ingrediente versátil que se puede disfrutar crudo en ensaladas, cocido en guisos o salteado en platos salteados.', 6, 550.00, 'RTEG21', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/530478/Chile-Dulce-Unidad-1-37227.jpg?v=638419993649800000'),
('Papas', 'Un vegetal versátil y reconfortante, apreciado por su sabor suave y textura cremosa cuando se cocina. Las papas son un ingrediente básico en muchas cocinas de todo el mundo y se pueden preparar de diversas formas, como horneadas, fritas, hervidas o como parte de guisos y ensaladas.', 6, 1160.00, 'LOK56', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/222879/Papa-Roja-Kg-6-A-8-Unidades-Por-Kg-Aproximadamente-1-35506.jpg?v=637626944891700000'),
('Lechuga', 'Una verdura fresca y crujiente, conocida por su sabor suave y refrescante. La lechuga es un ingrediente básico en ensaladas y sándwiches, y también se puede usar como base para envolturas y tacos.', 6, 1990.00, 'NDH76', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/164282/3-Pack-Lechuga-Salanova-Hidroponica-Unidad-1-38378.jpg?v=637536132869230000'),
('Cebolla', 'Un vegetal aromático y versátil, apreciado por su sabor distintivo y su capacidad para realzar el sabor de muchos platos. Las cebollas se pueden consumir crudas en ensaladas o salsas, o cocidas en guisos, salteados, sopas y muchos otros platillos.', 6, 11200.00, '0OPJK', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/164213/Cebolla-Mini-Malla-En-Red-1Kg-14-a-15-unidades-aproximadamente-1-37196.jpg?v=637536130704200000');
-- Insertar datos para la categoria Chocolates
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Tutto', 'Una marca reconocida por ofrecer una amplia variedad de productos de confitería y dulces, desde chocolates hasta caramelos y galletas. Tutto se destaca por su calidad excepcional y sabores irresistibles que deleitan a los amantes de los dulces en todo el mundo.', 7, 1750.00, 'LMHS2', 1100.00, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/447452/Chocolate-Tutto-Chocolover-200gr-2-28868.jpg?v=638307346138330000'),
('Hersheys', 'Una marca icónica de chocolates y dulces, conocida por su delicioso sabor y calidad inigualable. Desde sus clásicas barras de chocolate hasta sus diversos productos como Kisses, Reeses y Kit Kat, Hersheys ofrece una amplia gama de opciones para satisfacer cualquier antojo de dulces.', 7, 890.00, 'L24S6', 560.00, TRUE, 'https://i5.walmartimages.com/seo/Hershey-s-Milk-Chocolate-Full-Size-Candy-Bar-1-55-oz_feb583ea-ea7e-4f5e-9ad2-29194f8b0f5b.8cd556dc6eb45789af890172cbc351df.jpeg?odnHeight=768&odnWidth=768&odnBg=FFFFFF'),
('Milka', 'Una marca europea de chocolates y productos lácteos, reconocida por su distintivo envoltorio púrpura y su cremoso sabor. Milka ofrece una variedad de chocolates con diferentes rellenos y sabores, siendo su leche de los Alpes un ingrediente estrella que garantiza una experiencia de sabor suave y deliciosa.', 7, 990.00, '9762J', 790.00, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/566259/Chocolate-Milka-Chips-Ahoy-100gr-1-87023.jpg?v=638458983895970000'),
('Ferrero Rocher', 'Una marca italiana famosa por crear algunos de los chocolates más queridos del mundo, como Ferrero Rocher, Kinder Bueno y Nutella. Ferrero se caracteriza por su atención al detalle, calidad premium y sabores irresistibles que hacen que cada bocado sea una experiencia deliciosa y memorable.', 7, 2650.00, 'YTHD7', 1950.00, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/548359/Chocolate-Ferrer-Rocher-T8-100gr-1-24478.jpg?v=638442994503830000');
  
-- Insertar datos para la categoria Embutidos
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Jamón', 'Un delicioso embutido elaborado a partir de la pierna trasera del cerdo, conocido por su sabor salado y textura tierna. El jamón es un elemento básico en muchas cocinas y se puede disfrutar en una variedad de formas, desde lonchas finas en sándwiches hasta como ingrediente en ensaladas, pizzas y platos de pasta.', 8, 4400.00, '7HDSD', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/530440/Jam-n-Land-O-Frost-Cocido-Premium-454gr-1-34530.jpg?v=638419993472200000'),
('Salchichón', 'Un embutido curado elaborado con carne de cerdo y especias, conocido por su sabor intenso y aroma característico. El salchichón se suele consumir en lonchas finas como aperitivo o como parte de una tabla de embutidos, y también se puede usar como ingrediente en sándwiches y ensaladas.', 8, 1940.00, 'SPJEE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/376778/Salchich-n-Especial-Don-Cristobal-500gr-1-34430.jpg?v=638092317825530000'),
('Salchichas', 'Embutidos cilíndricos elaborados con carne picada y especias, conocidos por su sabor sabroso y versatilidad en la cocina. Las salchichas se pueden cocinar de diversas formas, ya sea a la parrilla, fritas, hervidas o asadas, y son un componente común en platos como hot dogs, guisos, pasta y desayunos.', 8, 5200.00, 'LDODH', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/390219/Salchichas-Johnsonville-Queso-Cheddar-396gr-1-58823.jpg?v=638157442371000000'),
('Paté', 'Una pasta untuosa y sabrosa elaborada con carne picada, hígado y especias, generalmente servida como aperitivo o entrada. El paté se puede encontrar en una variedad de sabores, como paté de hígado, paté de pollo o paté de vegetales, y se suele disfrutar untado en pan o galletas como parte de una tabla de quesos o embutidos.', 8, 660.00, 'YHDF3', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/554980/Pate-Cinta-Azul-Original-100g-2-32111.jpg?v=638448934061230000');

-- Insertar datos para la categoria Congelados
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Papas Fritas', 'Deliciosas rodajas de papa cortadas en tiras y fritas hasta que quedan doradas y crujientes. Las papas fritas son un clásico acompañamiento que se disfruta en todo el mundo, conocido por su sabor salado y textura crujiente. Perfectas como snack o como acompañamiento para hamburguesas, sándwiches y otros platos principales.', 9, 3500.00, '24FES', NULL, TRUE, 'https://www.supermaxonline.com/images_products/250022.jpg'),
('Tortas de Carne', 'Sabrosas hamburguesas de carne molida sazonada y formada en forma de disco, cocidas a la parrilla o a la plancha hasta que quedan doradas por fuera y jugosas por dentro. Las tortas de carne son una opción popular en muchas cocinas, ya sea servidas con pan como hamburguesa o acompañadas de vegetales y salsas como plato principal.', 9, 2600.00, 'HYD63', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/283684/Torta-El-Arreo-Congelado-De-Carne-6-Unidades-450gr-2-25695.jpg?v=637798773681870000'),
('Pollo Congelado', 'Piezas de pollo fresco que han sido limpiadas, cortadas y congeladas para preservar su frescura y sabor. El pollo congelado es una opción conveniente para tener en el congelador y se puede utilizar en una variedad de recetas, desde platos asados y guisados hasta frituras y sopas.', 9, 4900.00, '09KIS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/529688/Pollo-Don-Cristobal-Fajita-Pechuga-Congelada-650gr-2-35087.jpg?v=638419990114130000'),
('Waffles', 'Deliciosos gofres dorados y esponjosos, cocidos en una plancha caliente hasta que quedan crujientes por fuera y tiernos por dentro. Los waffles son un desayuno clásico que se sirve caliente y se puede disfrutar con una variedad de acompañamientos, como sirope de arce, frutas frescas, crema batida o incluso helado para un toque dulce.', 9, 1600.00, 'L826S', NULL, TRUE, 'https://i5.walmartimages.com.mx/gr/images/product-images/img_large/00750179167036L.jpg?odnHeight=612&odnWidth=612&odnBg=FFFFFF');

-- Insertar datos para la categoria Panaderia
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Pan Baguette', 'Largo y crujiente, el pan baguette es una deliciosa joya francesa perfecta para hacer bocadillos y acompañar comidas.', 10, 3500.00, '6732G', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/410374/Pan-Castellano-Blanco-400gr-1-85880.jpg?v=638215764681670000'),
('Pan Cuadrado', 'Delicioso y rectangular, el pan cuadrado es perfecto para hacer sándwiches y tostadas.', 10, 2600.00, 'SKI78', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/371861/Pan-Bimbo-Sandwich-Blaco-Xg-720gr-1-30675.jpg?v=638072446247870000'),
('Pan Italiano', 'El pan italiano es una obra maestra de la panadería, con su corteza crujiente y su miga suave y esponjosa. ', 10, 4900.00, '09LOS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/410375/Pan-Italiano-Blanco-150-gr-1-61239.jpg?v=638215764685100000'),
('Pan Rústico', 'Con su aspecto tosco y su sabor auténtico, el pan rústico nos transporta a la tradición y al encanto de la panadería artesanal', 10, 1600.00, 'LO098', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/263923/Pan-Rustico-Blanco-Bola-Bolsa-4-Un-280Gr-1-39656.jpg?v=637747257720670000');

-- Insertar datos para la categoria Lacteos
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Mantequilla', 'Untuosa y cremosa, perfecta para dar sabor a tus platos favoritos.', 11, 500.00, '6732G', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/248324/Mantequilla-Dos-Pinos-Light-210Gr-1-34165.jpg?v=637710432489400000'),
('Yogurt Griego', 'Rico en proteínas y cremoso en textura, ideal como desayuno o merienda saludable.', 11, 1600.00, 'SKI78', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/385153/Yogurt-Dos-Pinos-Griego-Sabor-Coco-200Ml-1-33697.jpg?v=638140702815130000'),
('Leche', 'Fuente natural de calcio y nutrientes esenciales, excelente para fortalecer huesos y músculos. ', 11, 2900.00, '09LOS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/302258/Leche-Sabemas-Uht-Entera-3-5-Grasa-1000Ml-2-28675.jpg?v=637848670559000000'),
('Leche Pinito', 'Información nutricional: 100% leche en polvo de vaca fuente natural de calcio, importante para la mineralización ósea y otros tejidos corporales. Leche en polvo 100% de vaca Fuente natural de calcio, importante para la mineralización de loss huesos y outros tejidos del cuerpo. Fuente de proteína altamente aprovechable para el organismo.', 11, 1300.00, 'LO098', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/406513/Leche-Pinito-En-Polvo-110gr-2-76218.jpg?v=638207238412930000');

-- Insertar datos para la categoria Lacteos
INSERT INTO productos (nombreProducto, descripcion, id_categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES
('Guaro Cacique', 'Cacique es una marca de aguardientes hechos a base de caña de azúcar típicos en Costa Rica, propiedad de la estatal Fábrica Nacional de Licores (FANAL). ​ Fue lanzada en 1980 y se compone de tres productos: guaro, ron Colorado y ginebra Extraconcha, que se consideran el pilar tradicional de los licores costarricenses.', 12, 5170.00, 'JS72G', NULL, TRUE, 'https://d1cft8rz0k7w99.cloudfront.net/n/f/a/2/f/fa2f431c698e1c3447e96ab25c5b8b4f5ed18322_Liqueur_118238_02.jpg'),
('Tequila Rose', 'Disfruta de los momentos de celebración con la suavidad y elegancia de Tequila Rose. Su sabor inigualable consta de una rica crema de fresa con el incomparable bocado del tequila. Su diseño elegante y detalles divertidos la convierten en el “pequeño vestido negro” de los licores de crema.', 12, 14310.00, 'K28SY', NULL, TRUE, 'https://d1cft8rz0k7w99.cloudfront.net/n/c/1/c/0/c1c01b95ca6fa063f9d1e6fe64fc5447ec29790c_Tequila_223168_01.jpg'),
('Johnnie Walker Blue Label', 'Johnnie Walker Blue Label proviene de la selección manual de Scotch Whiskies excepcionales con una notable complejidad de sabor. Solo una de cada 10 000 barricas cumple con los altos estándares. Sugerimos tomarlo solo, junto con un vaso de agua helada para realzar su carácter intenso.', 12, 15140.00, 'LW8DG', NULL, TRUE, 'https://vinumcr.com/wp-content/uploads/2020/06/1217090-Johnnie-Walker-Blue-Label-Whisky-4.jpg'),
('Whisky Jack Daniels Black', 'Producto con venta restringida, solo para mayores de 18 años.   Jack Daniels Está Elaborado Con La Mejor Malta De Maíz, Centeno Y Cebada. Su Carácter Distintivo Es El Resultado De La Fermentación Natural, La Destilación Cuidadosa Y El Uso Del Agua Sin Hierro De La Destilería De Cave Spring Que Corre A Una Temperatura Constante De 56 ° F', 12, 28110.00, '88S2H', NULL, TRUE, 'https://internetwines.com/cdn/shop/products/JackDanielsBlackLabelOldNo7_900x.jpg?v=1555348955');




-- SELECT * FROM ticorganiko.cliente;
-- SELECT * FROM ticorganiko.rol;
SELECT * FROM ticorganiko.productos;
SELECT * FROM ticorganiko.categorias;
-- SELECT * FROM ticorganiko.pedidos_productos;
-- SELECT * FROM ticorganiko.pedidos;