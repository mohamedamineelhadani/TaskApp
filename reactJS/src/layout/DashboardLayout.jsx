import React, { useState } from "react";
import { Outlet } from "react-router-dom";
import Footer from "./Footer/Footer";
import Header from "./Header/Header";
import SideBar from "./SideBar/SideBar";

const DashboardLayout = () => {
  const [sideBar, setSideBar] = useState(false);

  const toggleSideBar = () => {
    setSideBar(!sideBar);
  };

  return (
    <div className="dashboard-layout">
      <Header/>
      <main className="main-content">
        <Outlet />
      </main>
      <Footer />
    </div>
  );
};

export default DashboardLayout;
