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
  nombre VARCHAR(30) NOT NULL,
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

-- Crear la tabla de productos
CREATE TABLE productos (
  id_producto INT NOT NULL AUTO_INCREMENT,
  nombreProducto VARCHAR(30) NOT NULL,
  descripcion VARCHAR(350) NOT NULL,
  categoria VARCHAR(20) NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  codigo VARCHAR(6) NOT NULL,
  promocion DECIMAL(10, 2),
  activo BOOLEAN,
  ruta_imagen VARCHAR(1024),
  PRIMARY KEY (id_producto)
) ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

-- Crear la tabla de pedidos para el apartado de carrito
CREATE TABLE pedidos (
  id_pedido INT NOT NULL AUTO_INCREMENT,
  id_cliente INT NOT NULL,
  id_producto INT NOT NULL,
  PRIMARY KEY (id_pedido),
  FOREIGN KEY fk_pedido_cliente (id_cliente) REFERENCES cliente(id_cliente),
  FOREIGN KEY fk_pedido_producto (id_producto) REFERENCES productos(id_producto)
) ENGINE = InnoDB 
DEFAULT CHARACTER SET = utf8mb4;

-- Crear la tabla de factura para los clientes (Historial de Compras)
CREATE TABLE facturas (
  id_factura INT NOT NULL AUTO_INCREMENT,
  id_pedido INT NOT NULL,
  fecha_deCompra DATE NOT NULL,
  codigoFactura VARCHAR(15) NOT NULL,
  cantidad INT NOT NULL,
  precio_total DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (id_factura),
  FOREIGN KEY fk_factura_pedido (id_pedido) REFERENCES pedidos(id_pedido)
) ENGINE = InnoDB 
DEFAULT CHARACTER SET = utf8mb4;

create table rol (
  id_rol INT NOT NULL AUTO_INCREMENT,
  id_cliente INT NOT NULL,
  nombre VARCHAR(20),
  PRIMARY KEY (id_rol),
  FOREIGN KEY fk_rol_cliente (id_cliente) REFERENCES cliente(id_cliente)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

INSERT INTO cliente (id_cliente, nombre, correo, numero_telefono, direccion, cedula, username, password, ruta_imagen, activo) VALUES
(1, 'Juan Carlos Morales Silva', 'Juan1234@gmail.com', 123456789, ' San Jose - Residencial Los Pinos, Calle 5', 184720483, 'juan12', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://th.bing.com/th/id/OIP.GyMB5gJgjcN3koFUW6TRPwHaHa?w=500&h=500&rs=1&pid=ImgDetMain', true),
(2, 'Ana María Silva Flores', 'Ana5322@gmail.com', 12345678, 'Heredia - Residencial La Floresta, Calle Principal', 123456789, 'ana_maria53', '$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.', 'https://ab-innovativesolutions.com/wp-content/uploads/sites/5/2019/09/Persona-1-445x445.jpg', true),
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

INSERT INTO rol (id_rol, nombre, id_cliente) VALUES 
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
INSERT INTO productos (nombreProducto, descripcion, categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES 
  ('PushPops', 'Descripcion', 'Dulces', 2.99, 'CH74J2', NULL, TRUE, 'https://i5.walmartimages.com/seo/Jumbo-Push-Pop-Assorted-Flavor-Spring-Lollipop-1-06oz_b253883d-fb42-4627-8dd2-e31454ff5e84.8e0d92e5320a5b030106f04b5bbb8d3d.jpeg'),
  ('Snickers', 'Descripcion', 'Dulces', 1.99, 'GAU39D', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/287993/Chocolate-Snickers-Original-52-7gr-1-27216.jpg?v=637808279270500000'),
  ('Morenitos', 'Descripcion', 'Dulces', 0.99, 'CAY38C', NULL, TRUE, 'https://www.ticoshopping.com/cdn/shop/products/Capturadepantalla2022-11-30ala_s_11.19.50.png?v=1669828812'),
  ('Barrilete', 'Descripcion', 'Dulces', 12.99, 'PA194H', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/355592/Caramelo-Super-Barrilete-Sabor-Fruta-400gr-1-31710.jpg?v=638022551350570000');

-- Insertar datos para la categoría Bebidas
INSERT INTO productos (nombreProducto, descripcion, categoria, precio, codigo, promocion, activo, ruta_imagen)
VALUES 
  ('CocaCola', 'Coca Cola es una bebida azucarada gaseosa vendida a nivel
  mundial en tiendas, restaurantes y máquinas expendedoras en más de 
  doscientos países o territorios. Es el principal producto de The Coca-Cola 
  Company, de origen estadounidense.', 
  'Bebidas', 2150.40, '6XRSW8', NULL, TRUE, 'https://i5.walmartimages.ca/images/Enlarge/-bo/tle/coca-cola-2-liter-botle.jpg'),
  
  ('Fanta Kolita', 'Fanta Kolita es una bebida espumosa con una suave 
  mezcla de frutas exóticas y florales. Su carácter dulce y ligeramente ácido 
  puede recordarte a la granadina.', 
  'Bebidas', 693.40, 'AM01JS', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/463807/Gaseosa-Fanta-kolita-regular-600-ml-1-26343.jpg?v=638328299959800000'),
  
  ('Te Frio', 'La producción industrial de frescos de frutas 
  naturales en Costa Rica se inició en el año 2001, cuando Florida Bebidas 
  transformó el mercado nacional al introducir los frescos de frutas y 
  los tés fríos Tropical.', 
  'Bebidas', 3254.00, 'CF3DI4', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/353783/Refresco-Tropical-T-Frio-Lim-n-3000ml-1-55580.jpg?v=638018230229930000'),
  
    ('Pepsi', 'Pepsi es una famosa bebida carbonatada de cola 
  originaria de Estados Unidos. Nace en Carolina del Norte, en 1898, 
  inventada por Caleb B. Bradham, un químico farmacéutico que quería crear 
  un refresco delicioso que ayudara a la digestión y fuera un estimulante. ', 
  'Bebidas', 1904.00, 'J29NKE', NULL, TRUE, 'https://walmartcr.vtexassets.com/arquivos/ids/379645/Bebida-Gasificada-Pepsi-Cola-Pet-600ml-1-26361.jpg?v=638101823058770000');






-- SELECT * FROM ticorganiko.cliente;
-- SELECT * FROM ticorganiko.rol;
SELECT * FROM ticorganiko.productos;