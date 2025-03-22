import { useState, useEffect } from "react";
import axios from "axios";

const API_URL = "http://localhost/Prueba_InnoCloud";

const Ventas = () => {
  const [productos, setProductos] = useState([]);
  const [clientes, setClientes] = useState([]);
  const [ventas, setVentas] = useState([]);
  const [nuevaVentas, setNuevaVentas] = useState([]);
  const [productoSeleccionado, setProductoSeleccionado] = useState("");
  const [clienteSeleccionado, setClienteSeleccionado] = useState("");
  const [cantidad, setCantidad] = useState(1);
  const [mensajeOrden, setMensajeOrden] = useState(null);

  useEffect(() => {
    // Cargar clientes una sola vez al inicio
    axios.get(`${API_URL}/Cliente/getAll`)
      .then((res) => setClientes(res.data))
      .catch((error) => console.error("Error cargando clientes:", error));
  }, []);
  
  useEffect(() => {
    if (clienteSeleccionado) {
      // Cargar productos solo cuando se seleccione un cliente
      axios.get(`${API_URL}/Producto/getAllByCliente/clienteId=${clienteSeleccionado}`)
        .then((res) => setProductos(res.data))
        .catch((error) => console.error("Error cargando productos:", error.message));
    } else {
      setProductos([]);
    }
  }, [clienteSeleccionado]);


  const agregarVenta = () => {
    if (!productoSeleccionado || !clienteSeleccionado || cantidad <= 0) return;

    const producto = productos.find((p) => p.id === parseInt(productoSeleccionado));
    const total = cantidad * producto.price;

    setNuevaVentas((prevVentas) => ({
      ...prevVentas,
      cliente: clienteSeleccionado,
      details: [
        ...(prevVentas.details || []), // Mantiene los productos previos
        {
          idproducto: producto.id,
          cantidad,
          total
        }
      ]
    }));

    setVentas([...ventas, { ...producto, cantidad, total, cliente: clienteSeleccionado }]);
    setProductoSeleccionado("");
    setCantidad(1);
  };
 
  const eliminarProducto = (id) => {
    setVentas(ventas.filter((v) => v.id!== id));
  };

  const agregarOrden = () => {

    console.log("Orden generada:", nuevaVentas);
  
     axios.post(`${API_URL}/Order/save`, nuevaVentas)
      .then((res) => {
        console.log("Orden generada:", res.data)
        setMensajeOrden({ status: res.data.status, msg: res.data.msg, errors: res.data.errors || [] });
      }
      )
      .catch((error) => {
        console.error("Error generando orden:", error)
        setMensajeOrden({ status: false, msg: "Error al guardar la orden.", errors: [error.message] });
      });

    setVentas([]);
    setNuevaVentas([]);
    setProductoSeleccionado("");
    setClienteSeleccionado("");
    setCantidad(1);
  };

  // 🔹 Calcular total a pagar
  const calcularTotal = () => ventas.reduce((sum, p) => sum + p.total, 0).toFixed(2);

  return (
    <div className="p-6 max-w-8xl mx-auto">
      {/* Selección de cliente */}
      <div className="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 className="text-xl font-bold mb-4">Seleccionar Cliente</h2>
        <select
          className="w-full p-2 border rounded"
          value={clienteSeleccionado}
          onChange={(e) => setClienteSeleccionado(e.target.value)}
        >
          <option value="">Seleccione un cliente</option>
          {clientes.map((cliente) => (
            <option key={cliente.id} value={cliente.id}>
              {cliente.name}
            </option>
          ))}
        </select>
      </div>

      {/* Selección de productos */}
      <div className="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 className="text-xl font-bold mb-4">Seleccionar Producto</h2>
        <div className="grid grid-cols-3 gap-4">
          <select
            className="p-2 border rounded w-full"
            value={productoSeleccionado}
            onChange={(e) => setProductoSeleccionado(e.target.value)}
          >
            <option value="">Seleccione un producto</option>
            {productos.map((producto) => (
              <option key={producto.id} value={producto.id}>
                {producto.name} - ${producto.price}
              </option>
            ))}
          </select>
          <input
            type="number"
            min="1"
            className="p-2 border rounded w-full"
            placeholder="Cantidad"
            value={cantidad}
            onChange={(e) => setCantidad(Number(e.target.value))}
          />
          <button className="bg-blue-500 text-white p-2 rounded w-full" onClick={agregarVenta}>
            Agregar Producto
          </button>
        </div>
      </div>

      {/* Tabla de ventas */}
      <div className="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 className="text-xl font-bold mb-4">Detalle de Venta</h2>
        <table className="w-full border-collapse border">
          <thead>
            <tr className="bg-gray-200">
              <th className="border p-2">Cliente</th>
              <th className="border p-2">Producto</th>
              <th className="border p-2">Cantidad</th>
              <th className="border p-2">Precio</th>
              <th className="border p-2">Total</th>
            </tr>
          </thead>
          <tbody>
            {ventas.map((venta, index) => (
              <tr key={index} className="text-center">
                <td className="border p-2">
                  {clientes.find((c) => c.id === parseInt(venta.cliente))?.name || "Desconocido"}
                </td>
                <td className="border p-2">{venta.name}</td>
                <td className="border p-2">{venta.cantidad}</td>
                <td className="border p-2">${venta.price ? parseFloat(venta.price).toFixed(2) : "0.00"}</td>
                <td className="border p-2">${venta.total.toFixed(2)}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      {/* Total */}
      <div className="bg-white shadow-md rounded-lg p-6 flex justify-between items-center">
        <h2 className="text-xl font-bold">Total a Pagar:</h2>
        <span className="text-2xl font-semibold">${calcularTotal()}</span>
      </div>

      {/* Guardar orden */}
      <div className="bg-white shadow-md rounded-lg p-6 flex justify-between items-center">
          <button className="bg-blue-500 text-white p-2 rounded w-full" onClick={agregarOrden}>
            Save Orden
          </button>
      </div>
         {/* Mostrar mensaje de respuesta */}
         {mensajeOrden && (
        <div className={`mt-4 p-4 rounded w-full text-center ${mensajeOrden.status ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'}`}>
          <p>{mensajeOrden.msg}</p>
          {mensajeOrden.errors && mensajeOrden.errors.length > 0 && (
            <ul className="mt-2 text-sm text-red-600">
              {mensajeOrden.errors.map((error, index) => (
                <li key={index}>⚠ {error}</li>
              ))}
            </ul>
          )}
        </div>
      )}
    </div>
  );
};

export default Ventas;
