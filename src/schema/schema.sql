CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(128) NOT NULL,
    passkey TEXT NOT NULL
);

CREATE TABLE about (
    content_type ENUM('Intro', 'Motto') NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE aboutSubcategories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subcategory_name VARCHAR(128) NOT NULL,
    subcategory_content TEXT NOT NULL -- use '.' (period) as a delimiter/separator for each elements.
);

CREATE TABLE techSkillSubcategories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subcategory_name VARCHAR(128) NOT NULL,
    subcategory_content TEXT NOT NULL -- use '.' (period) as a delimiter/separator for each elements.
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(256) NOT NULL,
    project_image_filename TEXT NOT NULL,
    project_description TEXT NOT NULL,
    project_repository TEXT NOT NULL
);

CREATE TABLE education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    education_name VARCHAR(256) NOT NULL,
    education_type ENUM('Education', 'Certificate') NOT NULL,
    education_description TEXT NOT NULL
);

INSERT INTO users (username, passkey) VALUES ('user', 'user');
INSERT INTO about (content_type, content) VALUES
    ('Intro',
    'Hey there! I’m Francis, a passionate future software engineer who loves solving problems, experimenting with new technologies, and creating projects that make life a little easier (and a lot cooler). I’m constantly learning, improving, and pushing myself to build things that genuinely matter.'),
    ('Motto',
    '"If it ain''t broke, don''t fix it."');

INSERT INTO aboutSubcategories (subcategory_name, subcategory_content) VALUES
    ('Interests',
    'Problem solving. Coding. Playing video games (FPS, Racing, Simulators). Listening to music. Eating various delicacies. Cooking'),
    ('Strengths',
    'Problem solving. Coding. Playing video games. Collaborating with peers. Adaptability');

INSERT INTO techSkillSubcategories (subcategory_name, subcategory_content) VALUES
    ('Front-end', 'HTML 5. CSS 3. Tailwind CSS. JavaScript. AlpineJS. ReactJS'),
    ('Back-end', 'PHP. MySQL'),
    ('Programming', 'Python. Java. C++');

INSERT INTO projects (project_name, project_image_filename, project_description, project_repository) VALUES
    ('To-Do List using ReactJS',
    'to_do_list_screenshot.png',
    'First project while learning ReactJS and Vite.',
    'https://github.com/ntpyxl/ToDo-List'),
    ('Order Management System',
    'order_mgt_sys_screenshot.png',
    'Made along with AlpineJS. A system where cashiers can add items into the inventory and view transaction history, and admins, along with cashier priveleges, can also manage cashier accounts and status.',
    'https://github.com/ntpyxl/orderManagementSystem-withAlpineJS'),
    ('PixelType',
    'doc_edit_screenshot.png',
    'A document editor (or Google Docs ''clone'') with version history, document sharing and editing, and chat features.',
    'https://github.com/ntpyxl/PixelType-Docs-Clone'),
    ('Social Media Site',
    'socmed_site_screenshot.png',
    'A simple social media website where you can post and comment on posts.',
    'https://github.com/ntpyxl/SocMedSite');

INSERT INTO education (education_name, education_type, education_description) VALUES
    ('Emilio Aguinaldo College - Cavite (SHS)',
    'Education',
    'I graduated with honors under the strand of Technical-Vocational Livelihood - Information and Communication Technology on June 2022.'),
    ('Introduction to DevOps',
    'Certificate',
    'A coursera course published by IBM. Issued to me on August 2024. I learned about how the DevOps and agile software development life cycle works.'),
    ('Python for Data Science, AI & Development',
    'Certificate',
    'A Coursera course published by IBM. Issued to me on July 2024. I learned about how to use Python and libraries such as numpy, pandas, and matplotlib in the field of Data Science.');