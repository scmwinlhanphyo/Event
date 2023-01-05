import React from 'react';
import Pagination from 'react-bootstrap/Pagination';
import styles from './EventPagination.module.css';

const EventPagination = ({metadata}) => {
  const [items, setItems] = React.useState([]);
  const [pageNo, setPageNo] = React.useState(1);

  React.useEffect(() => {
    changePagination(metadata.pageNumber|| 1);
  }, []);

  const changePagination = (pageNumber) => {
    let data = [];
    let loopCount = metadata.totalPages;
    if (metadata.totalPages > 5) {
      loopCount = 4
    };

    for (let number = 1; number <= loopCount; number++) {
      data.push(
        <Pagination.Item key={number} active={number === pageNumber}>
          {number}
        </Pagination.Item>,
      );
    }
    setItems(data);
    setPageNo(pageNumber);
  }
  
  return (
  <div className={styles.paginationContainer}>
    <Pagination>
      <Pagination.First />
      <Pagination.Prev />
      <Pagination onClick={(event) => changePagination(Number(event.target.text))}>{items}</Pagination>
      {metadata.totalPages > 5 &&
      (<>
      <Pagination.Ellipsis />
        <Pagination.Item active={metadata.totalPages === pageNo} onClick={() => changePagination(metadata.totalPages)}>{metadata.totalPages}</Pagination.Item>
        </>)
      }
      <Pagination.Next />
      <Pagination.Last />
    </Pagination>
    <br />
  </div>);
};

export default EventPagination;