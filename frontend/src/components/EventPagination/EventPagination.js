import React from 'react';
import Pagination from 'react-bootstrap/Pagination';
import styles from './EventPagination.module.scss';

const EventPagination = ({ metadata }) => {
  const [items, setItems] = React.useState([]);
  const [pageNo, setPageNo] = React.useState(1);

  React.useEffect(() => {
    changePagination(metadata.pageNumber || 1);
  }, []);

  const changePagination = (pageNumber) => {
    pageNumber = pageNumber < 1 ? 1 : pageNumber > metadata.totalPages ? metadata.totalPages : pageNumber;
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
        <Pagination.First onClick={(event) => changePagination(1)} />
        <Pagination.Prev onClick={(event) => changePagination(pageNo - 1)} />
        <Pagination onClick={(event) => changePagination(Number(event.target.text))}>{items}</Pagination>
        {metadata.totalPages > 5 &&
          (<>
            <Pagination.Ellipsis />
            <Pagination.Item active={metadata.totalPages === pageNo} onClick={() => changePagination(metadata.totalPages)}>{metadata.totalPages}</Pagination.Item>
          </>)
        }
        <Pagination.Next onClick={(event) => changePagination(pageNo + 1)} />
        <Pagination.Last onClick={(event) => changePagination(Number(metadata.totalPages))} />
      </Pagination>
      <br />
    </div>);
};

export default EventPagination;