import React, { useEffect, useState } from "react";
import axios from "axios";

const API_URL = "http://localhost/Prueba_InnoCloud";

const ListaOrdenes = () => {
  const [ordenes, setOrdenes] = useState([]);

  useEffect(() => {
    axios.get(`${API_URL}/Order/getAll`)
      .then((res) => setOrdenes(res.data))
      .catch((error) => console.error("Error cargando órdenes:", error));
  }, []);

  return (
    <div className="p-6 bg-white shadow-lg rounded-lg">
      <h2 className="text-2xl font-semibold mb-4">Órdenes Realizadas</h2>

      <div className="overflow-x-auto">
        <table className="w-full border-collapse border border-gray-200">
          <thead className="bg-gray-100">
            <tr>
              <th className="border px-4 py-2 text-left">ID</th>
              <th className="border px-4 py-2 text-left">Cliente</th>
              <th className="border px-4 py-2 text-left">Fecha</th>
            </tr>
          </thead>
          <tbody>
            {ordenes.length > 0 ? (
              ordenes.map((orden) => (
                <tr key={orden.id} className="border">
                  <td className="border px-4 py-2">{orden.id}</td>
                  <td className="border px-4 py-2">{orden.client_id}</td>
                  <td className="border px-4 py-2">{orden.created_at}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4" className="text-center py-4">
                  No hay órdenes registradas.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ListaOrdenes;
