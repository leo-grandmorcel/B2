<?php

// class BinaryNode
// {
//     public ?int $value = null; // Node value
//     public ?BinaryNode $left = null; // Left child
//     public ?BinaryNode $right = null; // Right child

//     public function __construct(int $value)
//     {
//         $this->value = $value;
//     }
// }

function invertTree(BinaryNode | null $root): BinaryNode
{
    if ($root === null) {
        return new BinaryNode(0);
    }

    $left = invertTree($root->left);
    $right = invertTree($root->right);

    $root->left = $right;
    $root->right = $left;

    return $root;
}