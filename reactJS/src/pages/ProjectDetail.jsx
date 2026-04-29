import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { projectApi, taskApi } from '../service/resourceApi';

const ProjectDetail = () => {
  const { id } = useParams();
  const [project, setProject] = useState(null);
  const [tasks, setTasks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [taskForm, setTaskForm] = useState({ title: '', description: '' });
  const [showTaskForm, setShowTaskForm] = useState(false);
  const [saving, setSaving] = useState(false);

  const fetchProject = async () => {
    try {
      const res = await projectApi.getById(id);
      setProject(res.project);
      setTasks(res.tasks);
    } catch (err) { console.error(err); }
    finally { setLoading(false); }
  };

  useEffect(() => { fetchProject(); }, [id]);

  const handleAddTask = async (e) => {
    e.preventDefault();
    setSaving(true);
    try {
      await taskApi.create(id, taskForm);
      setTaskForm({ title: '', description: '' });
      setShowTaskForm(false);
      fetchProject();
    } catch (err) { console.error(err); }
    finally { setSaving(false); }
  };

  const toggleTask = async (taskId) => {
    try { await taskApi.toggleStatus(taskId); fetchProject(); }
    catch (err) { console.error(err); }
  };

  const deleteTask = async (taskId) => {
    if (!confirm('Delete this task?')) return;
    try { await taskApi.delete(taskId); fetchProject(); }
    catch (err) { console.error(err); }
  };

  const completeAll = async () => {
    try { await taskApi.completeAll(id); fetchProject(); }
    catch (err) { console.error(err); }
  };

  if (loading) return <div className="loading-screen"><div className="loading-spinner"></div></div>;
  if (!project) return <div className="empty-state"><p>Project not found</p></div>;

  return (
    <div>
      <Link to="/projects" className="back-link">← Back to Projects</Link>

      <div className="project-detail-header">
        <div>
          <h1 className="page-title">{project.name}</h1>
          <p className="page-subtitle">{project.description || 'No description'}</p>
        </div>
        <div style={{ display: 'flex', gap: '8px', alignItems: 'center' }}>
          <span className={`status-badge status-${project.status}`}>{project.status}</span>
          <button className="btn btn-primary btn-sm" onClick={() => setShowTaskForm(!showTaskForm)}>+ Add Task</button>
          {tasks.length > 0 && <button className="btn btn-success btn-sm" onClick={completeAll}>✓ Complete All</button>}
        </div>
      </div>

      {showTaskForm && (
        <div className="card" style={{ marginBottom: '20px' }}>
          <div className="card-body">
            <form onSubmit={handleAddTask} style={{ display: 'flex', gap: '12px', flexWrap: 'wrap' }}>
              <input placeholder="Task title..." value={taskForm.title} onChange={e => setTaskForm({ ...taskForm, title: e.target.value })}
                required style={{ flex: 1, minWidth: '200px', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
              <input placeholder="Description (optional)" value={taskForm.description} onChange={e => setTaskForm({ ...taskForm, description: e.target.value })}
                style={{ flex: 1, minWidth: '200px', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
              <button className="btn btn-primary" type="submit" disabled={saving}>{saving ? 'Adding...' : 'Add'}</button>
              <button className="btn btn-ghost" type="button" onClick={() => setShowTaskForm(false)}>Cancel</button>
            </form>
          </div>
        </div>
      )}

      <div className="card">
        <div className="card-header">
          <h2 className="card-title">Tasks ({tasks.length})</h2>
        </div>
        <div className="card-body">
          {tasks.length > 0 ? (
            <div className="tasks-list">
              {tasks.map(task => (
                <div className="task-item" key={task.id}>
                  <button className={`task-checkbox ${task.status === 'completed' ? 'checked' : ''}`} onClick={() => toggleTask(task.id)}>
                    {task.status === 'completed' && '✓'}
                  </button>
                  <div className="task-info">
                    <div className={`task-title ${task.status === 'completed' ? 'completed' : ''}`}>{task.title}</div>
                    {task.description && <div className="task-desc">{task.description}</div>}
                  </div>
                  <div className="task-actions">
                    <button className="btn btn-danger btn-sm" onClick={() => deleteTask(task.id)}>Delete</button>
                  </div>
                </div>
              ))}
            </div>
          ) : (
            <div className="empty-state"><p>No tasks yet. Add your first task above!</p></div>
          )}
        </div>
      </div>
    </div>
  );
};

export default ProjectDetail;
