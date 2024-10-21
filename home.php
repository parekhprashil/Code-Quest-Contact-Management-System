<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("location: index.php");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "contact_managment_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch contacts for the logged-in user
    $sql = "SELECT * FROM contactdetails WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Store contacts in an array
    $contacts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
    }

    $stmt->close();
    $conn->close();
    $merge_status = isset($_GET['merge_status']) ? $_GET['merge_status'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Quest: Contact Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .scrollable-area {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Code Quest: Contact Management System</h1>
            <a href="con_logout.php" class="bg-white text-blue-600 px-4 py-2 rounded shadow">Logout</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto mt-8 px-4">
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Manage Your Contacts Seamlessly</h2>
            <p class="text-gray-600 mb-4">Add, edit, remove, search, and organize your contacts with ease. Import from VCF files, merge duplicates, and maintain a well-organized contact list.</p>
            <div class="flex flex-wrap gap-4">
                <a href="addcontact.php" class="btn bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Add Contact</a>
                <button onclick="openModal();" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">Import Contacts</button>
                <a href="export.php?userid=$user_id" class="btn bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600">Export Contacts</a>
                <a href="mergeduplicate.php" class="btn bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">Merge Duplicates</a>
            </div>
        </section>

        <div id="importModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Import Contacts</h2>
                    <form action="import.php" method="POST" enctype="multipart/form-data">
                        <label class="block mb-2 text-gray-600" for="importFile">Choose a file:</label>
                        <input type="file" name="importFile" id="importFile" class="block w-full text-gray-700 border border-gray-300 rounded-lg p-2 mb-4">
                        
                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded shadow hover:bg-gray-500">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function openModal() {
                document.getElementById('importModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('importModal').classList.add('hidden');
            }
            const mergeStatus = "<?php echo $merge_status; ?>";

        if (mergeStatus === 'success') {
            alert('Duplicates merged successfully!');
        } else if (mergeStatus === 'error') {
            alert('Error occurred while merging duplicates.');
        } else if (mergeStatus === 'no_duplicates') {
            alert('No duplicate contacts found.');
        }
        </script>
        <!-- Search Contacts Section -->
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Contacts</h2>
            <div class="flex items-center bg-white shadow-lg rounded-lg p-4">
                <input type="text" class="w-full border border-gray-300 rounded p-2" placeholder="Search by name, email, or phone..." id="searchInput" oninput="searchContacts()">
            </div>
        </section>

        <!-- Contact List Section -->
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Contacts</h2>
            <div id="contactList" class="bg-white shadow-lg rounded-lg p-4 scrollable-area grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Contact Cards will be dynamically rendered here -->
                <?php if (count($contacts) > 0): ?>
                    <script>
                        let contacts = <?= json_encode($contacts) ?>;
                        
                        function renderContacts(contactList) {
                            const container = document.getElementById('contactList');
                            container.innerHTML = ''; // Clear previous content
                            
                            if (contactList.length === 0) {
                                container.innerHTML = '<p class="text-center text-gray-500 mt-4">No contacts found.</p>';
                            } else {
                                contactList.forEach(contact => {
                                    container.innerHTML += `
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center justify-between relative">
                                            <div class="flex items-center">
                                                <div class="w-12 h-12">
                                                    <img src="https://via.placeholder.com/150" alt="Profile Image" class="w-full h-full rounded-full object-cover">
                                                </div>
                                                <div class="ml-4">
                                                    <h3 class="text-lg font-bold text-gray-800">${contact.contact_name}</h3>
                                                    <p class="text-gray-600">${contact.contact_phone_number}</p>
                                                    <p class="text-gray-600">${contact.contact_email_id}</p>
                                                </div>
                                            </div>
                                            <button class="text-gray-600 hover:text-gray-800" onclick="toggleMenu(${contact.id})">
                                                &#x22EE;
                                            </button>
                                            <div id="menu-${contact.id}" class="hidden absolute right-4 bg-white shadow-lg rounded-lg mt-2 py-2 w-32">
                                                <a href="editcontact.php?id=${contact.id}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Update</a>
                                                <a href="con_delete_contact.php?id=${contact.id}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
                                            </div>
                                        </div>
                                    `;
                                });
                            }
                        }

                        function searchContacts() {
                            const query = document.getElementById('searchInput').value.toLowerCase();
                            const filteredContacts = contacts.filter(contact =>
                                contact.contact_name.toLowerCase().includes(query) ||
                                contact.contact_phone_number.includes(query) ||
                                contact.contact_email_id.toLowerCase().includes(query)
                            );
                            renderContacts(filteredContacts);
                        }

                        function toggleMenu(id) {
                            const menu = document.getElementById(`menu-${id}`);
                            document.querySelectorAll('[id^="menu-"]').forEach(el => el.classList.add('hidden'));
                            menu.classList.toggle('hidden');
                        }

                        // Initial Render
                        renderContacts(contacts);
                    </script>
                <?php else: ?>
                    <p class="text-center text-gray-500 mt-4">No contacts available.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8 ">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; 2024 Code Quest - All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>
