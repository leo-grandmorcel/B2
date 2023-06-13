namespace CSharpDiscovery.Quest03
{
    public class Campus : PointOfInterest
    {
        public int Capacity { get; set; }

        public override string ToString()
        {
            return String.Format("{0} is a campus with a capacity of {1} students", Name, Capacity);
        }
    }
}
