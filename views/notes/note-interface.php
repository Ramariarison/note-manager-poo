<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/note-interface.css">
    <title>Page de notes</title>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="hero-sidebar">
                <div class="image-section">
                    <img src="../assets/images/a.jpg" alt="Profile" class="profil-icon">
                </div>
                <div class="nom-utilisateur">
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </div>
            <div class="main">
                <div class="sidebar-links">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-sticky-note"></i>
                                <span>Notes List</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Profile account</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-history"></i>
                                <span>Historical</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-line-chart"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="logout">
                    <a href="#" class="logout-button">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </aside>
        <div class="page-content">
            <div class="page-header">
                <h2 class="page-title">My notes</h2>
                <!--
                <div class="btn-add-card">
                    <div class="btn-add">
                        <i class="fa fa-plus"></i>
                        New note
                    </div>
                </div>
                -->
                <div class="header-actions">
                    <!-- Recherche -->
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <!-- Filtre -->
                    <div class="filter-box">
                        <i class="fa fa-filter"></i>
                        <select>
                            <option value="None">Sort</option>
                            <option value="Critical">Critical</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <!-- Bouton d'ajout -->
                    <div class="btn-add">
                            <i class="fa fa-plus"></i>
                            <span>Add</span>
                    </div>
                </div>
            </div>
            <!-- Liste de notes -->
            <div class="notes-grid">
                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level">C</span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date">23-11-2020</span>
                            </div>
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                        </div>
                        <div class="note-title">
                            <span>Amazon</span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                L'amour est un sentiment profond d'affection et d'attachement, 
                                unissant deux personnes par un désir de proximité physique, 
                                intellectuelle ou émotionnelle.
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--
                        <div class="actions-btns">
                            <button class="view">
                                <a href="#">view</a>
                            </button>
                            <button class="edit">
                                <a href="#">edit</a>
                            </button>
                            <button class="delete">
                                <a href="#">delete</a>
                            </button>
                        </div>
                        -->
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button class="edit">
                                    <i class="fa fa-pencil"></i>
                                    <span>edit</span>
                                </button>
                            </div>
                            <div class="delete-icon">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level">C</span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date">23-11-2020</span>
                            </div>
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                        </div>
                        <div class="note-title">
                            <span>Amazon</span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                L'amour est un sentiment profond d'affection et d'attachement, 
                                unissant deux personnes par un désir de proximité physique, 
                                intellectuelle ou émotionnelle.
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--
                        <div class="actions-btns">
                            <button class="view">
                                <a href="#">view</a>
                            </button>
                            <button class="edit">
                                <a href="#">edit</a>
                            </button>
                            <button class="delete">
                                <a href="#">delete</a>
                            </button>
                        </div>
                        -->
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button class="edit">
                                    <i class="fa fa-pencil"></i>
                                    <span>edit</span>
                                </button>
                            </div>
                            <div class="delete-icon">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level">C</span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date">23-11-2020</span>
                            </div>
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                        </div>
                        <div class="note-title">
                            <span>Amazon</span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                L'amour est un sentiment profond d'affection et d'attachement, 
                                unissant deux personnes par un désir de proximité physique, 
                                intellectuelle ou émotionnelle.
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--
                        <div class="actions-btns">
                            <button class="view">
                                <a href="#">view</a>
                            </button>
                            <button class="edit">
                                <a href="#">edit</a>
                            </button>
                            <button class="delete">
                                <a href="#">delete</a>
                            </button>
                        </div>
                        -->
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button class="edit">
                                    <i class="fa fa-pencil"></i>
                                    <span>edit</span>
                                </button>
                            </div>
                            <div class="delete-icon">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level">C</span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date">23-11-2020</span>
                            </div>
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                        </div>
                        <div class="note-title">
                            <span>Amazon</span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                L'amour est un sentiment profond d'affection et d'attachement, 
                                unissant deux personnes par un désir de proximité physique, 
                                intellectuelle ou émotionnelle.
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--
                        <div class="actions-btns">
                            <button class="view">
                                <a href="#">view</a>
                            </button>
                            <button class="edit">
                                <a href="#">edit</a>
                            </button>
                            <button class="delete">
                                <a href="#">delete</a>
                            </button>
                        </div>
                        -->
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button class="edit">
                                    <i class="fa fa-pencil"></i>
                                    <span>edit</span>
                                </button>
                            </div>
                            <div class="delete-icon">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level">C</span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date">23-11-2020</span>
                            </div>
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                        </div>
                        <div class="note-title">
                            <span>Amazon</span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                L'amour est un sentiment profond d'affection et d'attachement, 
                                unissant deux personnes par un désir de proximité physique, 
                                intellectuelle ou émotionnelle.
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--
                        <div class="actions-btns">
                            <button class="view">
                                <a href="#">view</a>
                            </button>
                            <button class="edit">
                                <a href="#">edit</a>
                            </button>
                            <button class="delete">
                                <a href="#">delete</a>
                            </button>
                        </div>
                        -->
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button class="edit">
                                    <i class="fa fa-pencil"></i>
                                    <span>edit</span>
                                </button>
                            </div>
                            <div class="delete-icon">
                                <i class="fa fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>