# Prueba_InnoCloud

# 🛒 Sistema de Gestión de Ventas

Este proyecto es una aplicación web que permite gestionar ventas, productos y clientes.  
Está compuesto por una **API (Backend)** desarrollada en **PHP** y un **Frontend** desarrollado en **React con Vite**.

en cada rama esta la configuracion de cada proyecto.
---

## 🚀 Tecnologías Utilizadas

### 📌 Backend (API)
- PHP puro
- MySQL (Base de datos)
- CORS habilitado para conexión con el frontend

### 📌 Frontend (React con Vite)

- React 18 + Vite
- TailwindCSS
- Axios para peticiones HTTP
- React Router Dom para navegación
- plantilla free justada a las necesidades para rapida gestion

base datos 
![tienda](https://github.com/user-attachments/assets/70bb4bf6-1ca8-4842-93f6-54d5dc38b5b1)


# Agregar productos 

1. Ejecute el script donde insertara segun los clientes ya establecidos.
2. agregue valores segun sea necesario y que existen los clientes y producto, si no le causara una exceptionSql.
```sh
  INSERT INTO client_product (id, client_id, product_id) VALUES(0, 2, 1);
   
