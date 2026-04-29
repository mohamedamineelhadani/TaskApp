import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { dashboardApi } from '../service/resourceApi';
import { 
  FolderKanban, 
  CircleCheck, 
  Clock, 
  TrendingUp,
  ArrowRight,
  Plus
} from 'lucide-react';

const Dashboard = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchDashboard = async () => {
      try {
        const res = await dashboardApi.getStats();
        setData(res);
      } catch (err) {
        console.error('Dashboard error:', err);
      } finally {
        setLoading(false);
      }
    };
    fetchDashboard();
  }, []);

  if (loading) return <div className="loading-screen"><div className="loading-spinner"></div></div>;

  const stats = data?.stats || {};

  return (
    <div>
      <div className="page-header">
        <h1 className="page-title">Dashboard</h1>
        <p className="page-subtitle">Your project overview at a glance</p>
      </div>

      <div className="stats-grid">
        <div className="stat-card">
          <div className="stat-card-header">
            <span className="stat-label">Total Projects</span>
            <div className="stat-icon primary">
              <FolderKanban size={24} />
            </div>
          </div>
          <div className="stat-value">{stats.total_projects || 0}</div>
        </div>
        <div className="stat-card">
          <div className="stat-card-header">
            <span className="stat-label">Completed</span>
            <div className="stat-icon success">
              <CircleCheck size={24} />
            </div>
          </div>
          <div className="stat-value">{stats.completed_projects || 0}</div>
        </div>
        <div className="stat-card">
          <div className="stat-card-header">
            <span className="stat-label">Pending Tasks</span>
            <div className="stat-icon warning">
              <Clock size={24} />
            </div>
          </div>
          <div className="stat-value">{stats.pending_tasks || 0}</div>
        </div>
        <div className="stat-card">
          <div className="stat-card-header">
            <span className="stat-label">Completion Rate</span>
            <div className="stat-icon danger">
              <TrendingUp size={24} />
            </div>
          </div>
          <div className="stat-value">{stats.completion_rate || 0}%</div>
        </div>
      </div>

      <div className="card">
        <div className="card-header">
          <h2 className="card-title">Recent Projects</h2>
          <Link to="/projects" className="btn btn-ghost btn-sm">
            View All
            <ArrowRight size={14} style={{ marginLeft: '4px' }} />
          </Link>
        </div>
        <div className="card-body">
          {data?.recent_projects?.length > 0 ? (
            <div className="tasks-list">
              {data.recent_projects.map(project => (
                <Link to={`/projects/${project.id}`} key={project.id} className="task-item" style={{ textDecoration: 'none' }}>
                  <div className="task-info">
                    <div className="task-title">{project.name}</div>
                    <div className="task-desc">{project.tasks_count} tasks</div>
                  </div>
                  <span className={`status-badge status-${project.status}`}>{project.status}</span>
                </Link>
              ))}
            </div>
          ) : (
            <div className="empty-state">
              <p>No projects yet. <Link to="/projects">Create your first project →</Link></p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Dashboard;