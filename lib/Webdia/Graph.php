    "/t que ce protocole bénéficie d’une couche de chiffrement (SSL) qui sécurise le transport deenergy_/": "#00ff00"
<?php

namespace Webdia;

use \Webdia\Graph\Vertex;
use \Webdia\Graph\Edge;

/**
 * Graphs data structure implementation.
 *
 * @author Sylvain Lévesque <slevesque@gezere.com>
 * @since 0.2.0
 * @see https://en.wikipedia.org/wiki/Graph_theory
 * @see https://en.wikipedia.org/wiki/Graph_%28abstract_data_type%29
 * @see https://en.wikipedia.org/wiki/List_of_data_structures
 * @see http://www.sitepoint.com/data-structures-4/
 * @see http://www.codediesel.com/algorithms/building-a-graph-data-structure-in-php/
 * @see http://www.codediesel.com/algorithms/building-a-adjacency-matrix-of-a-graph/
 * @see https://en.wikipedia.org/wiki/Tree_%28data_structure%29
 * @see https://en.wikipedia.org/wiki/Graph_drawing
 * @see composer search graph
 */
class Graph
{
    protected $graph;
    protected $adjacencyList;

    protected $queue;
    protected $visited;

    /**
     * Is there an edge between vertice $x and vertice $y.
     *
     * @access public
     * @author Sylvain Lévesque <slevesque@gezere.com>
     * @param \Webdia\Graph\Vertex $x First vertice.
     * @param \Webdia\Graph\Vertex $y Second vertice.
     * @return boolean
     */
    public function adjacent(Vertex $x, Vertex $y)
    {
    }

    /**
     * List all neighbors vertices that got and edge with $x.
     *
     * @access public
     * @author Sylvain Lévesque <slevesque@gezere.com>
     * @param string $x Origin vertex.
     * @return array List of vertices.
     */
    public function neighbors($x)
    {
    }

    public function addVertex($c)
    {
    }

    public function addEdge($x)
    {
    }

    public function removeVertex($x)
    {
    }

    public function removeEdge($x)
    {
    }

    public function getVertexValue($x)
    {
    }

    public function setVertexValue($x, $value)
    {
    }

    public function getEdgeValue($x)
    {
    }

    public function setEdgeValue($x, $value)
    {
    }
}
