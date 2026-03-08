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

            <?php if(!empty($successupdate)) : ?>
                <div class="toast-success" id="toastSuccess">
                    <i class="fa fa-check-circle"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <div class="page-header">
                <h2 class="page-title">My notes</h2>
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
                    <div class="btn-add" id="openModal">
                            <i class="fa fa-plus"></i>
                            <span>Add</span>
                    </div>
                </div>
            </div>
            <!-- Liste de notes -->
            <div class="notes-grid">

                <?php foreach ($notes as $note): ?>

                <!-- Card -->
                <div class="note-card">
                    <div class="card-header">
                        <div class="note-priority">
                            <span class="priority-level"><?= htmlspecialchars(substr($note['importance_level'],0,1)) ?></span>
                        </div>
                        <div class="btn-to-pin-note">
                            <button class="pin-note">pin note</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="note-date-and-hour">
                            <div class="note-date">
                                <span class="date"><?= htmlspecialchars($note['created_at']) ?></span>
                            </div>
                            <!--
                            <div class="note-hour">
                                <span class="hour">15h:30min</span>
                            </div>
                            -->
                        </div>
                        <div class="note-title">
                            <span><?= htmlspecialchars($note['title']) ?></span>
                        </div>
                        <div class="note-content">
                            <span class="content">
                                <?= htmlspecialchars($note['content']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="actions-btns">
                            <div class="left-actions">
                                <button class="view">
                                    <i class="fa fa-eye"></i>
                                    <span>view</span>
                                </button>
                                <button 
                                    class="edit"
                                    data-id="<?= $note['id'] ?>"
                                    data-title="<?= htmlspecialchars($note['title']) ?>"
                                    data-content="<?= htmlspecialchars($note['content']) ?>" 
                                    data-priority="<?= $note['importance_level'] ?>"  
                                >
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

                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- Modal for adding a new note -->

    <div class="modal" id="noteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><span class="add-note">Add</span> Note</h3>
                <span class="close-btn" id="closeModal">&times;</span>
            </div>

            <form action="/crashProject/public/notes/store" method="post">
                <div class="form-group">
                    <label>Note title</label>
                    <input type="text" name="title" placeholder="Title" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" rows="4" placeholder="exampleexample..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Priority</label>
                    <select name="importance_level">
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Save Note</button>
            </form>
        </div>
    </div>

    <!-- Modal for the note editing -->

    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><span class="add-note">Edit</span> Note</h3>
                <span class="close-btn" id="closeEditModal">&times;</span>
            </div>

            <?php if(!empty($errorupdate)) : ?>
                <div class="alert-error" id="errorUpdate">
                    <?= htmlspecialchars($error) ?>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const editModal = document.getElementById("editModal");
                        editModal.style.display = "block";
                    });
                </script>

            <?php endif; ?>

            <form action="/crashProject/public/notes/update" method="post">

                <?php $old = $old ?? []; ?>

                <input type="hidden" name="id" value="<?= htmlspecialchars($old['id'] ?? '') ?>"  id="editNoteId">

                <div class="form-group">
                    <label>Note title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>" id="editTitle" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" id="editContent" rows="4"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label>Priority</label>
                    <select name="importance_level" id="editPriority">
                        <option value="Critical" <?= ($old['importance_level'] ?? '') === 'Critical' ? 'selected' : '' ?>>Critical</option>
                        <option value="High" <?= ($old['importance_level'] ?? '') === 'High' ? 'selected' : '' ?>>High</option>
                        <option value="Medium" <?= ($old['importance_level'] ?? '') === 'Medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="Low" <?= ($old['importance_level'] ?? '') === 'Low' ? 'selected' : '' ?>>Low</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Update Note</button>

            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById("noteModal");
        const openBtn = document.getElementById("openModal");
        const closeBtn = document.getElementById("closeModal");

        openBtn.onclick = function() {
            modal.style.display = "block";
        }

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        const editModal = document.getElementById("editModal");
        const closeEditModal = document.getElementById("closeEditModal");

        document.querySelectorAll(".edit").forEach(button => {

            button.addEventListener("click", function(){

                document.getElementById("editNoteId").value = this.dataset.id;
                document.getElementById("editTitle").value = this.dataset.title;
                document.getElementById("editContent").value = this.dataset.content;
                document.getElementById("editPriority").value = this.dataset.priority;

                editModal.style.display = "block";
            });

        });

        closeEditModal.onclick = function(){
            editModal.style.display = "none";
        }

        // Toast message

        const toast = document.getElementById("toastSuccess");

        if(toast){

            setTimeout(() => {
                toast.classList.add("toast-hide");
            },3000);

        }

        // Error update no changes message

        const nothing = document.getElementById("errorUpdate");

        if(nothing){

            setTimeout(() => {
                nothing.classList.add("nothing-hide");
            },3000);
        }
        
    </script>

</body>
</html>