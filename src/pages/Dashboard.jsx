import React, { useState } from 'react';

import WelcomeBanner from '../partials/dashboard/WelcomeBanner';

import Home from '../partials';
import Ventas from '../partials/dashboard/Ventas';
import ListaOrdenes from '../partials/dashboard/ListaOrdenes';

function Dashboard() {

  const [sidebarOpen, setSidebarOpen] = useState(false);

  return (

    <Home>
      <main>
        <div className="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

          {/* Welcome banner */}
          <WelcomeBanner />
        
          {/* Cards */}
          <div className="grid grid-cols-2 gap-1">

            {/* ventas */}
            <Ventas />
            <ListaOrdenes />

          </div>

        </div>
      </main>
    </Home>
  );
}

export default Dashboard;