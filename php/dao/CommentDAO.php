<?php
    class CommentDAO {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function create(Comment $comment) {
            $postId = $comment->getPostId();
            $userId = $comment->getUserId();
            $text = $comment->getText();

            $stmt = $this->conn->prepare("INSERT INTO comments (post_id, user_id, text, dt) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iis", $postId, $userId, $text);
            $stmt->execute();

            $id = $stmt->insert_id;
            $comment->setId($id);

            $stmt->close();
        }
    }
?>