# Prueba_InnoCloud
# 🛒 Sistema de Gestión de Ventas

Este proyecto es una aplicación web que permite gestionar ventas, productos y clientes.  
Está compuesto por una **API (Backend)** desarrollada en **PHP y un **Frontend** desarrollado en **React con Vite**.

En la base del proyecto se encuentra un archivo json para importar en postman.
o los script para ingresar las consultas en Mysql.
---
Todo realizado en base de pruebas.

## 🚀 Tecnologías Utilizadas

### 📌 Backend (API)
- PHP puro
- Arquitectura microservicios con principios de independencia.
- MySQL (Base de datos)
- CORS habilitado para conexión con el frontend

📌 Endpoints de la API
Método	Endpoint	Descripción
GET	/Producto/getAll	Listar productos
GET	Cliente/getAll	Listar clientes
POST	/Order/save	Crear una nueva Orden
GET	/Order/getAll/	Listar Oordenes

## 📌 Instalación y Configuración

### 🖥️ Backend (API)
1. Clonar el repositorio rama (Servicio-Api-PHP):
   ```sh
   git clone https://github.com/ruder12/Prueba_InnoCloud.git
   cd Prueba_InnoCloud
2. crear la base de datos de mysql de nombre **tienda**, abre tu gestor y ejecuta los script que estan en la raiz del proyecto de nombre: script.sql
3. si utiliza xampp como servidor apache, guarda el proyecto en htdocs con el nombre de **Prueba_InnoCloud**
4. de lo contrario guarda el proyecto donde tengas el servidor de apache desplegado, con las mismas condiciones la carpata **Prueba_InnoCloud**
5. este seria el ej: de como quedaria el EndPoint : http://localhost/Prueba_InnoCloud/Order/getAll
6. una vez desplagado puedes importar el archivo json Prueba_InnoCloud.postman_collection para postman
7. probar la api insertar y obtener datos.
8. pasar al front una vez este todo ok.

ejepmlo de consultas: 
![imagen](https://github.com/user-attachments/assets/01323af2-339c-4447-a4b7-55faf1fbf91c)
