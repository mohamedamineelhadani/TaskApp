import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { projectApi } from '../service/resourceApi';
import { Search, Plus, ListTodo, Pencil, Trash2, X } from 'lucide-react';

const Projects = () => {
  const [projects, setProjects] = useState([]);
  const [search, setSearch] = useState('');
  const [loading, setLoading] = useState(true);
  const [showModal, setShowModal] = useState(false);
  const [editProject, setEditProject] = useState(null);
  const [form, setForm] = useState({ name: '', description: '', status: 'pending' });
  const [saving, setSaving] = useState(false);

  const fetchProjects = async () => {
    try {
      const res = await projectApi.getAll(search);
      setProjects(res);
    } catch (err) { console.error(err); }
    finally { setLoading(false); }
  };

  useEffect(() => { fetchProjects(); }, [search]);

  const openCreate = () => { setEditProject(null); setForm({ name: '', description: '', status: 'pending' }); setShowModal(true); };
  const openEdit = (p) => { setEditProject(p); setForm({ name: p.name, description: p.description || '', status: p.status }); setShowModal(true); };

  const handleSave = async (e) => {
    e.preventDefault();
    setSaving(true);
    try {
      if (editProject) {
        await projectApi.update(editProject.id, form);
      } else {
        await projectApi.create(form);
      }
      setShowModal(false);
      fetchProjects();
    } catch (err) { console.error(err); }
    finally { setSaving(false); }
  };

  const handleDelete = async (id) => {
    if (!confirm('Delete this project?')) return;
    try { await projectApi.delete(id); fetchProjects(); } catch (err) { console.error(err); }
  };

  if (loading) return <div className="loading-screen"><div className="loading-spinner"></div></div>;

  return (
    <div>
      <div className="page-header">
        <h1 className="page-title">Projects</h1>
        <p className="page-subtitle">Manage all your projects</p>
      </div>

      <div className="projects-toolbar">
        <div className="search-box">
          <span className="search-icon"><Search size={16} /></span>
          <input placeholder="Search projects..." value={search} onChange={e => setSearch(e.target.value)} />
        </div>
        <button className="btn btn-primary" onClick={openCreate}>+ New Project</button>
      </div>

      {projects.length > 0 ? (
        <div className="projects-grid">
          {projects.map(p => (
            <div className="project-card" key={p.id}>
              <div className="project-card-header">
                <Link to={`/projects/${p.id}`} className="project-name">{p.name}</Link>
                <span className={`status-badge status-${p.status}`}>{p.status}</span>
              </div>
              <p className="project-desc">{p.description || 'No description'}</p>
              <div className="project-meta">
                <span className="project-tasks-count"><ListTodo size={16} /> {p.tasks_count || 0} tasks</span>
                <div style={{ display: 'flex', gap: '8px' }}>
                  <button className="btn btn-ghost btn-sm" onClick={() => openEdit(p)}>Edit</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(p.id)}>Delete</button>
                </div>
              </div>
            </div>
          ))}
        </div>
      ) : (
        <div className="empty-state">
          <p>No projects found. Create your first project to get started!</p>
        </div>
      )}

      {showModal && (
        <div className="modal-overlay" onClick={() => setShowModal(false)}>
          <div className="modal" onClick={e => e.stopPropagation()}>
            <div className="modal-header">
              <h3 className="modal-title">{editProject ? 'Edit Project' : 'New Project'}</h3>
              <button className="modal-close" onClick={() => setShowModal(false)}>×</button>
            </div>
            <form onSubmit={handleSave}>
              <div className="modal-body">
                <div className="form-group">
                  <label>Project Name</label>
                  <input value={form.name} onChange={e => setForm({ ...form, name: e.target.value })} required />
                </div>
                <div className="form-group">
                  <label>Description</label>
                  <textarea value={form.description} onChange={e => setForm({ ...form, description: e.target.value })} rows={3} />
                </div>
                <div className="form-group">
                  <label>Status</label>
                  <select value={form.status} onChange={e => setForm({ ...form, status: e.target.value })}>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                  </select>
                </div>
              </div>
              <div className="modal-footer">
                <button type="button" className="btn btn-ghost" onClick={() => setShowModal(false)}>Cancel</button>
                <button type="submit" className="btn btn-primary" disabled={saving}>{saving ? 'Saving...' : 'Save'}</button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
};

export default Projects;
