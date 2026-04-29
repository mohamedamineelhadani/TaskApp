import React, { useState } from "react";
import { Outlet, NavLink, useNavigate } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

const DashboardLayout = () => {
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = async () => {
    await logout();
    navigate("/login");
  };

  const closeSidebar = () => setSidebarOpen(false);

  return (
    <div className="dashboard-layout">
      <aside className={`sidebar ${sidebarOpen ? "open" : ""}`}>
        <div className="sidebar-header">
          <div className="sidebar-logo"><span>TaskApp</span></div>
          <button className="sidebar-close" onClick={closeSidebar}>✕</button>
        </div>
        <nav className="sidebar-nav" onClick={closeSidebar}>
          <NavLink to="/dashboard">Dashboard</NavLink>
          <NavLink to="/projects">Projects</NavLink>
          <NavLink to="/contact">Contact</NavLink>
          <NavLink to="/about">About</NavLink>
          <NavLink to="/profile">Profile</NavLink>
        </nav>
        <div className="sidebar-user">
          <div className="sidebar-user-info">
            <div className="sidebar-avatar">{user?.name?.charAt(0).toUpperCase()}</div>
            <div>
              <div className="sidebar-user-name">{user?.name}</div>
              <div className="sidebar-user-email">{user?.email}</div>
            </div>
          </div>
        </div>
      </aside>

      <div className={`mobile-overlay ${sidebarOpen ? "show" : ""}`} onClick={closeSidebar}></div>

      <div className="main-wrapper">
        <header className="top-bar">
          <button className="menu-toggle" onClick={() => setSidebarOpen(true)}>☰</button>
          <div className="top-bar-right">
            <span style={{ fontSize: ".85rem", color: "var(--text-secondary)" }}>
              Welcome, <strong>{user?.name}</strong>
            </span>
            <button className="btn btn-ghost btn-sm" onClick={handleLogout}>Logout</button>
          </div>
        </header>
        <main className="main-content">
          <Outlet />
        </main>
        <footer className="app-footer">
          © {new Date().getFullYear()} TaskApp — Built with ReactJS and Laravel(API)
        </footer>
      </div>
    </div>
  );
};

export default DashboardLayout;
